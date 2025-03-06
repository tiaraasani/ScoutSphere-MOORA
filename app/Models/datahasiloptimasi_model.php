<?php 

namespace App\Models;

use CodeIgniter\Model;

class datahasiloptimasi_model extends Model
{
    protected $table = 'view_hasil';

    function __construct()
    {
        $this->db = db_connect();
    }

    function tampilhasil()
    {
        $query = $this->db->query('select * from view_hasil');
        return $query->getResult();
    }

}