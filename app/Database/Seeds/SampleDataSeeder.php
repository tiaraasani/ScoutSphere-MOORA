<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\CLI\CLI;
use CodeIgniter\Database\Seeder;

/**
 * Loads a small example data set so the MOORA pages can be tried out
 * on a fresh installation. Skips when data already exists.
 *
 * Usage: php spark db:seed SampleDataSeeder
 */
class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        if ($this->db->table('kriteria')->countAllResults() > 0 || $this->db->table('alternatif')->countAllResults() > 0) {
            CLI::write('Existing data found, sample data not loaded.', 'yellow');

            return;
        }

        $this->db->table('kriteria')->insertBatch([
            ['kriteria' => 'C1', 'nama' => 'Prestasi',     'bobot' => 0.35, 'jenis' => 'benefit'],
            ['kriteria' => 'C2', 'nama' => 'Keaktifan',    'bobot' => 0.30, 'jenis' => 'benefit'],
            ['kriteria' => 'C3', 'nama' => 'Kedisiplinan', 'bobot' => 0.20, 'jenis' => 'benefit'],
            ['kriteria' => 'C4', 'nama' => 'Pelanggaran',  'bobot' => 0.15, 'jenis' => 'cost'],
        ]);

        $this->db->table('alternatif')->insertBatch([
            ['kode' => 'A01', 'nama' => 'Andi Saputra'],
            ['kode' => 'A02', 'nama' => 'Budi Santoso'],
            ['kode' => 'A03', 'nama' => 'Citra Lestari'],
            ['kode' => 'A04', 'nama' => 'Dewi Anggraini'],
        ]);

        $criteria     = array_column($this->db->table('kriteria')->select('id, kriteria')->get()->getResultArray(), 'id', 'kriteria');
        $alternatives = array_column($this->db->table('alternatif')->select('id, kode')->get()->getResultArray(), 'id', 'kode');

        $scores = [
            'A01' => ['C1' => 85, 'C2' => 80, 'C3' => 90, 'C4' => 2],
            'A02' => ['C1' => 78, 'C2' => 88, 'C3' => 75, 'C4' => 1],
            'A03' => ['C1' => 92, 'C2' => 70, 'C3' => 85, 'C4' => 3],
            'A04' => ['C1' => 80, 'C2' => 85, 'C3' => 80, 'C4' => 0],
        ];

        $rows = [];

        foreach ($scores as $code => $values) {
            foreach ($values as $criterionCode => $value) {
                $rows[] = [
                    'id_peserta'  => $alternatives[$code],
                    'id_kriteria' => $criteria[$criterionCode],
                    'nilai'       => $value,
                ];
            }
        }

        $this->db->table('matriks')->insertBatch($rows);

        CLI::write('Sample data loaded: 4 criteria, 4 alternatives, 16 matrix values.', 'green');
    }
}
