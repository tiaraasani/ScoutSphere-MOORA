<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Database\Seeder;
use RuntimeException;

/**
 * Creates the initial administrator account.
 *
 * Credentials are read from the ADMIN_USERNAME and ADMIN_PASSWORD
 * environment variables so that no password is ever stored in the code.
 *
 * Usage: php spark db:seed AdminUserSeeder
 */
class AdminUserSeeder extends Seeder
{
    private const MIN_PASSWORD_LENGTH = 12;

    public function run(): void
    {
        $username = trim((string) env('ADMIN_USERNAME', ''));
        $password = (string) env('ADMIN_PASSWORD', '');

        if ($username === '' || strlen($password) < self::MIN_PASSWORD_LENGTH) {
            throw new RuntimeException(sprintf(
                'Set ADMIN_USERNAME and ADMIN_PASSWORD (at least %d characters) in .env before seeding.',
                self::MIN_PASSWORD_LENGTH
            ));
        }

        $users = new UserModel();

        if ($users->findByUsername($username) !== null) {
            CLI::write(sprintf('User "%s" already exists, nothing to do.', $username), 'yellow');

            return;
        }

        $users->insert([
            'username'      => $username,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        CLI::write(sprintf('User "%s" created.', $username), 'green');
    }
}
