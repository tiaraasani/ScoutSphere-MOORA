<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

/**
 * Read-only access to the MOORA weighted normalisation step.
 *
 * Backed by the database view `view_optimasi_moora`.
 */
class WeightedNormalizationModel extends Model
{
    protected $table      = 'view_optimasi_moora';
    protected $returnType = 'object';
}
