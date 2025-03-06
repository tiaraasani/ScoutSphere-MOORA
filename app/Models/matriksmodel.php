<?php

namespace App\Models;

use CodeIgniter\Model;

class matriksmodel extends Model
{
    protected $table = 'matriks';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_peserta',
        'id_kriteria',
        'nilai'
    ];

    function _construct()
    {
        $this->db = db_connect();
    }
    function simpanmatriks($table, $data)
    {
        $this->db->table($table)->insert($data);
        return true;
    }
    function tampildata()
    {
        $dataquery = $this->db->query(
            "
            SELECT * FROM matriks
            "
        );
        return $dataquery->getResult();
    }
    public function getmatriksid($id){
        $dataquery=$this->db->query("select * from matriks where id_peserta=".$id);
        return $dataquery -> getResult();
    }
    public function proseseditmatriks($table, $data, $where)
    {
        $this->db->table($table)->update($data, $where);
        return true;
    }
    public function hapusmatriks($table, $where)
    {
        return $this->db->table($table)->where($where)->delete();
    }
    
    public function countmatriks()
    {
        return $this->countAll();
    }
}
