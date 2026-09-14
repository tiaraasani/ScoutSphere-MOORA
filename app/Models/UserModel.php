<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

/**
 * Application users allowed to sign in to the admin panel.
 *
 * Table: users (id, username, password_hash, created_at, updated_at)
 */
class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['username', 'password_hash'];
    protected $useTimestamps = true;

    /**
     * @return array<string, mixed>|null
     */
    public function findByUsername(string $username): ?array
    {
        return $this->where('username', $username)->first();
    }
}
