<?php

declare(strict_types=1);

namespace Tests\Support\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * SQLite-compatible copy of the application tables for feature tests.
 *
 * The production migration uses MySQL-only features (ENUM columns and the
 * MOORA views), so tests get a lean schema covering just the tables the
 * controllers write to.
 */
class CreateTestSchema extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'            => ['type' => 'INTEGER', 'auto_increment' => true],
            'username'      => ['type' => 'VARCHAR', 'constraint' => 50],
            'password_hash' => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('users');

        $this->forge->addField([
            'id'   => ['type' => 'INTEGER', 'auto_increment' => true],
            'kode' => ['type' => 'VARCHAR', 'constraint' => 20],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('alternatif');

        $this->forge->addField([
            'id'       => ['type' => 'INTEGER', 'auto_increment' => true],
            'kriteria' => ['type' => 'VARCHAR', 'constraint' => 10],
            'nama'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'bobot'    => ['type' => 'DECIMAL', 'constraint' => '8,4'],
            'jenis'    => ['type' => 'VARCHAR', 'constraint' => 10],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('kriteria');

        $this->forge->addField([
            'id'          => ['type' => 'INTEGER', 'auto_increment' => true],
            'id_peserta'  => ['type' => 'INTEGER'],
            'id_kriteria' => ['type' => 'INTEGER'],
            'nilai'       => ['type' => 'DECIMAL', 'constraint' => '12,4'],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('matriks');
    }

    public function down(): void
    {
        $this->forge->dropTable('matriks', true);
        $this->forge->dropTable('kriteria', true);
        $this->forge->dropTable('alternatif', true);
        $this->forge->dropTable('users', true);
    }
}
