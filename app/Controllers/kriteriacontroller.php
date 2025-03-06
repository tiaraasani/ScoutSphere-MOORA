<?php

namespace App\Controllers;

use App\Models\kriteriamodel;
use App\Models\bobotmodel;

class kriteriacontroller extends BaseController
{

    public function __construct()
    {
        $this->kriteriamodel = new kriteriamodel();
    }
    public function viewkriteria()
    {
        $kr = new kriteriamodel();
        $datakr = $kr->tampildata();
        $data = array('datakr' => $datakr);
        echo view('Admin_header');
        echo view('Admin_nav');
        echo view('kriteria', $data);
        echo view('Admin_footer');
    }
    public function inputkr()
    {

        $kr = new kriteriamodel();
        $data = [
            'data' => $kr->tampildata() // Ambil data dari model
        ];
        echo view('Admin_header');
        echo view('Admin_nav');
        echo view('forminputkriteria',$data);
        echo view('Admin_footer');
    }
    public function simpankr()
    {
        // Get form data
        $kriteria = $this->request->getPost('kriteria');
        $nama = $this->request->getPost('nama');
        $bobot = $this->request->getPost('bobot');
        $jenis = $this->request->getPost('jenis');

        // Create an array for the data
        $data = [
            'kriteria' => $kriteria,
            'nama' => $nama,
            'bobot' => $bobot,
            'jenis' => $jenis,
        ];
        $kr = new kriteriamodel();
        $table = "kriteria";
        $kr->simpankriteria($table, $data);
        return redirect()->to(site_url('datakriteria/view'));
    }
    public function formeditkr($id)
    {
        $kriteria = new kriteriamodel();
        $datakriteria = $kriteria->getkriteria($id);
        $data = array('datakr' => $datakriteria);

        echo view('Admin_header');
        echo view('Admin_nav');
        echo view('formeditkriteria', $data);
        echo view('Admin_footer');
    }
    public function editkr($No)
    {
        $kriteria = $this->request->getPost('kode');
        $nama = $this->request->getPost('nama');
        $bobot = $this->request->getPost('bobot');
        $tipe = $this->request->getPost('tipe');

        $data = [
            'kriteria' => $kriteria,
            'nama' => $nama,
            'bobot' => $bobot,
            'jenis' => $tipe,
        ];

        $where = ['id' => $No];
        $kr = new kriteriamodel();
        $table = "kriteria";
        $kr->proseseditkriteria($table, $data, $where);
        return redirect()->to(site_url('datakriteria/view'));
    }
    public function hapuskr($No)
    {
        $kr = new kriteriamodel();
        $hapus = $kr->hapuskriteria($No);
        return redirect()->to(site_url('datakriteria/view'));
    }
}
