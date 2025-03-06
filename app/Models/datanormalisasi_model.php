<?php
namespace App\Models;
use CodeIgniter\Model;

class datanormalisasi_model extends Model
{
    protected $table = 'view_normalisasi_moora';

    function __construct()
    {
        $this->db = db_connect();
    }

    function tampilnormalisasi()
    {
        $query = $this->db->query("select * from view_normalisasi_moora");
        return $query->getResult();
    }
}
