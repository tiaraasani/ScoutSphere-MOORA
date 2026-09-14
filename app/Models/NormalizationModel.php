<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

/**
 * Read-only access to the MOORA normalisation step.
 *
 * Backed by the database view `view_normalisasi_moora`.
 */
class NormalizationModel extends Model
{
    protected $table      = 'view_normalisasi_moora';
    protected $returnType = 'object';
}
