<?php
namespace App\Models;

use CodeIgniter\Model;

class dataoptimasi_model extends Model
{
    protected $table = 'view_optimasi_moora';

    function __construct()
    {
        $this->db = db_connect();
    }

    function tampiloptimasi()
    {
        $query = $this->db->query("select * from view_optimasi_moora");
        return $query->getResult();
    }

}