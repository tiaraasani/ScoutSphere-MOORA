<?php

namespace App\Models;

use CodeIgniter\Model;

class MatrikskeputusanModel extends Model
{
    protected $table = 'matrikskeputusan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idpengajar', 'idkriteria', 'idskala'];

    public function count() {
        return $this->countAll();
    }
}