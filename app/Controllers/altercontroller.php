<?php

namespace App\Controllers;

use App\Models\altermodel;
use App\Models\jenisusahaodel;

class altercontroller extends BaseController
{

    public function __construct()
    {
        $this->altermodel = new altermodel();
    }
    public function viewalter()
    {
        $alter = new altermodel();
        $dataalter = $alter->tampildata();
        $data = array('dataalter' => $dataalter);
        echo view('Admin_header');
        echo view('Admin_nav');
        echo view('dataalter', $data);
        echo view('Admin_footer');
    }
    public function inputalter()
    {

        echo view('Admin_header');
        echo view('Admin_nav');
        echo view('forminputalter');
        echo view('Admin_footer');
    }
    public function simpanalter()
    {
        // Get form data
        $nama = $this->request->getPost('nama');
        $kode = $this->request->getPost('kode');

        // Create an array for the data
        $data = [
            'nama' => $nama,
            'kode' => $kode
        ];
        $alter = new altermodel();
        $table = "alternatif";
        $alter->simpanalter($table, $data);
        return redirect()->to(site_url('dataalter/view'));
    }
    public function formeditalter($No)
    {

        $alter = new altermodel();
        $dataalter = $alter->getalter($No);
        $data = array('dataalter' => $dataalter);

        echo view('Admin_header');
        echo view('Admin_nav');
        echo view('formeditalter', $data);
        echo view('Admin_footer');
    }
    public function editalter($No)
    {
        // Get form data
        $nama = $this->request->getPost('nama');

        // Create an array for the data
        $data = [
            'nama' => $nama
        ];

        $where = ['id' => $No];
        $alter = new altermodel();
        $table = "alternatif";
        $alter->proseseditalter($table, $data, $where);
        return redirect()->to(site_url('dataalter/view'));
    }
    public function hapusalter($No)
    {
        $alter = new altermodel();
        $hapus = $alter->hapusalter($No);
        return redirect()->to(site_url('dataalter/view'));
    }
}
