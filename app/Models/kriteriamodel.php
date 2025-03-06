<?php
namespace App\Models;
use CodeIgniter\Model;

class kriteriamodel extends Model{
    protected $table = 'kriteria';

    function _construct(){
        $this->db = db_connect();

    }
    function simpankriteria($table, $data){
        $this->db->table($table)->insert($data);
        return true;
    }
    function tampildata(){
        $dataquery=$this->db->query("select * from kriteria");
        return $dataquery -> getResult();
    }
    public function getkriteria($id){
        $dataquery=$this->db->query("select * from kriteria where id=".$id);
        return $dataquery -> getResult();
    }
    public function proseseditkriteria($table,$data,$where){
        $this->db->table($table)->update($data,$where);
        return true;
    }
    function hapuskriteria($id){
        $dataquery=$this->db->query("delete from kriteria where id=".$id);
        return true;
    }
    public function countkriteria() {
        return $this->countAll();
    }
}
?>