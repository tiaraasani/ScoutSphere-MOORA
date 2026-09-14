<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

/**
 * Alternatives are the scout participants ranked by the MOORA method.
 *
 * Table: alternatif (id, kode, nama)
 */
class AlternativeModel extends Model
{
    protected $table         = 'alternatif';
    protected $primaryKey    = 'id';
    protected $returnType    = 'object';
    protected $allowedFields = ['kode', 'nama'];

    /**
     * @return list<object>
     */
    public function findAllOrdered(): array
    {
        return $this->orderBy('id', 'ASC')->findAll();
    }
}
