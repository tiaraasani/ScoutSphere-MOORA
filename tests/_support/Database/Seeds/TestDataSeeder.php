<?php

declare(strict_types=1);

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Minimal fixture used by the feature tests.
 *
 * One admin user, two criteria, two participants, and matrix values for the
 * first participant only (so the second one counts as "not yet scored").
 */
class TestDataSeeder extends Seeder
{
    public const ADMIN_USERNAME = 'admin';
    public const ADMIN_PASSWORD = 'rahasia-sekali-12';

    public function run(): void
    {
        $this->db->table('users')->insert([
            'username'      => self::ADMIN_USERNAME,
            'password_hash' => password_hash(self::ADMIN_PASSWORD, PASSWORD_BCRYPT, ['cost' => 4]),
        ]);

        $this->db->table('kriteria')->insertBatch([
            ['id' => 1, 'kriteria' => 'C1', 'nama' => 'Prestasi',    'bobot' => 0.6, 'jenis' => 'benefit'],
            ['id' => 2, 'kriteria' => 'C2', 'nama' => 'Pelanggaran', 'bobot' => 0.4, 'jenis' => 'cost'],
        ]);

        $this->db->table('alternatif')->insertBatch([
            ['id' => 1, 'kode' => 'A01', 'nama' => 'Andi Saputra'],
            ['id' => 2, 'kode' => 'A02', 'nama' => 'Budi Santoso'],
        ]);

        $this->db->table('matriks')->insertBatch([
            ['id_peserta' => 1, 'id_kriteria' => 1, 'nilai' => 80],
            ['id_peserta' => 1, 'id_kriteria' => 2, 'nilai' => 2],
        ]);
    }
}
