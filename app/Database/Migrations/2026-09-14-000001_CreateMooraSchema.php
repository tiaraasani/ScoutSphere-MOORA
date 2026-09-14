<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Core MOORA schema: alternatives, criteria, the decision matrix, and the
 * database views that perform every calculation step.
 *
 * View chain (each one builds on the previous):
 *   view_pembagi_moora      sqrt(sum(x^2)) per criterion (vector divisor)
 *   view_normalisasi_moora  x / divisor
 *   view_optimasi_moora     weight * normalised value
 *   view_skor_moora         sum(benefit) - sum(cost) per alternative
 *   view_hasil              preference score with rank
 */
class CreateMooraSchema extends Migration
{
    private const VIEWS = [
        'view_hasil',
        'view_skor_moora',
        'view_optimasi_moora',
        'view_normalisasi_moora',
        'view_pembagi_moora',
    ];

    public function up(): void
    {
        $this->createAlternatifTable();
        $this->createKriteriaTable();
        $this->createMatriksTable();
        $this->createViews();
    }

    public function down(): void
    {
        foreach (self::VIEWS as $view) {
            $this->db->query("DROP VIEW IF EXISTS {$view}");
        }

        $this->forge->dropTable('matriks', true);
        $this->forge->dropTable('kriteria', true);
        $this->forge->dropTable('alternatif', true);
    }

    private function createAlternatifTable(): void
    {
        $this->forge->addField([
            'id'   => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'kode' => ['type' => 'VARCHAR', 'constraint' => 20],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('kode');
        $this->forge->createTable('alternatif');
    }

    private function createKriteriaTable(): void
    {
        $this->forge->addField([
            'id'       => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'kriteria' => ['type' => 'VARCHAR', 'constraint' => 10],
            'nama'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'bobot'    => ['type' => 'DECIMAL', 'constraint' => '8,4', 'unsigned' => true],
            'jenis'    => ['type' => 'ENUM', 'constraint' => ['benefit', 'cost']],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('kriteria');
        $this->forge->createTable('kriteria');
    }

    private function createMatriksTable(): void
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_peserta'  => ['type' => 'INT', 'unsigned' => true],
            'id_kriteria' => ['type' => 'INT', 'unsigned' => true],
            'nilai'       => ['type' => 'DECIMAL', 'constraint' => '12,4', 'unsigned' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['id_peserta', 'id_kriteria']);
        $this->forge->addForeignKey('id_peserta', 'alternatif', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_kriteria', 'kriteria', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('matriks');
    }

    private function createViews(): void
    {
        $this->db->query(<<<'SQL'
            CREATE OR REPLACE VIEW view_pembagi_moora AS
            SELECT id_kriteria, SQRT(SUM(nilai * nilai)) AS pembagi
            FROM matriks
            GROUP BY id_kriteria
            SQL);

        $this->db->query(<<<'SQL'
            CREATE OR REPLACE VIEW view_normalisasi_moora AS
            SELECT
                m.id_peserta,
                m.id_kriteria,
                a.kode     AS kode_peserta,
                a.nama     AS nama_peserta,
                k.kriteria AS kode_kriteria,
                k.nama     AS nama_kriteria,
                k.jenis,
                k.bobot,
                m.nilai,
                ROUND(m.nilai / NULLIF(d.pembagi, 0), 4) AS nilai_normalisasi
            FROM matriks AS m
            INNER JOIN alternatif         AS a ON a.id = m.id_peserta
            INNER JOIN kriteria           AS k ON k.id = m.id_kriteria
            INNER JOIN view_pembagi_moora AS d ON d.id_kriteria = m.id_kriteria
            ORDER BY m.id_peserta, m.id_kriteria
            SQL);

        $this->db->query(<<<'SQL'
            CREATE OR REPLACE VIEW view_optimasi_moora AS
            SELECT
                id_peserta,
                id_kriteria,
                kode_peserta,
                nama_peserta,
                kode_kriteria,
                nama_kriteria,
                jenis,
                bobot,
                nilai_normalisasi,
                ROUND(bobot * nilai_normalisasi, 4) AS nilai_berbobot
            FROM view_normalisasi_moora
            ORDER BY id_peserta, id_kriteria
            SQL);

        $this->db->query(<<<'SQL'
            CREATE OR REPLACE VIEW view_skor_moora AS
            SELECT
                id_peserta,
                kode_peserta,
                nama_peserta,
                ROUND(COALESCE(SUM(CASE WHEN jenis = 'benefit' THEN nilai_berbobot END), 0), 4) AS maximum,
                ROUND(COALESCE(SUM(CASE WHEN jenis = 'cost'    THEN nilai_berbobot END), 0), 4) AS minimum,
                ROUND(
                    COALESCE(SUM(CASE WHEN jenis = 'benefit' THEN nilai_berbobot END), 0)
                  - COALESCE(SUM(CASE WHEN jenis = 'cost'    THEN nilai_berbobot END), 0),
                4) AS skor_preferensi
            FROM view_optimasi_moora
            GROUP BY id_peserta, kode_peserta, nama_peserta
            SQL);

        $this->db->query(<<<'SQL'
            CREATE OR REPLACE VIEW view_hasil AS
            SELECT
                s.id_peserta,
                s.kode_peserta,
                s.nama_peserta,
                s.maximum,
                s.minimum,
                s.skor_preferensi,
                (
                    SELECT COUNT(*) + 1
                    FROM view_skor_moora AS o
                    WHERE o.skor_preferensi > s.skor_preferensi
                ) AS peringkat
            FROM view_skor_moora AS s
            ORDER BY peringkat, s.nama_peserta
            SQL);
    }
}
