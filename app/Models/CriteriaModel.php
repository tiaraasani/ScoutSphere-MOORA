<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

/**
 * Criteria used to score each alternative.
 *
 * Table: kriteria (id, kriteria, nama, bobot, jenis)
 */
class CriteriaModel extends Model
{
    /**
     * Allowed values for the `jenis` column. A benefit criterion is
     * maximised, a cost criterion is minimised.
     */
    public const TYPES = ['benefit', 'cost'];

    protected $table         = 'kriteria';
    protected $primaryKey    = 'id';
    protected $returnType    = 'object';
    protected $allowedFields = ['kriteria', 'nama', 'bobot', 'jenis'];

    /**
     * @return list<object>
     */
    public function findAllOrdered(): array
    {
        return $this->orderBy('id', 'ASC')->findAll();
    }
}
