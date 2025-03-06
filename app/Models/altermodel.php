<?php
namespace App\Models;
use CodeIgniter\Model;

class altermodel extends Model{
    protected $table = 'alternatif';

    function _construct(){
        $this->db = db_connect();

    }
    function simpanalter($table, $data){
        $this->db->table($table)->insert($data);
        return true;
    }
    function tampildata(){
        $dataquery=$this->db->query("select * from alternatif");
        return $dataquery -> getResult();
    }
    public function getalter($id){
        $dataquery=$this->db->query("select * from alternatif where id=".$id);
        return $dataquery -> getResult();
    }
    public function proseseditalter($table,$data,$where){
        $this->db->table($table)->update($data,$where);
        return true;
    }
    function hapusalter($id){
        $dataquery=$this->db->query("delete from alternatif where id=".$id);
        return true;
    }
    public function countalter() {
        return $this->countAll();
    }
}
?>