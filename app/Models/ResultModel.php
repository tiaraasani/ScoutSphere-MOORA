<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

/**
 * Read-only access to the final MOORA preference scores and ranking.
 *
 * Backed by the database view `view_hasil`.
 */
class ResultModel extends Model
{
    protected $table      = 'view_hasil';
    protected $returnType = 'object';

    /**
     * @return list<object>
     */
    public function findRanked(): array
    {
        return $this->orderBy('peringkat', 'ASC')->findAll();
    }
}
