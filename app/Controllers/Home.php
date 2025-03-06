<?php

namespace App\Controllers;

use App\Models\altermodel;
use App\Models\datahasiloptimasi_model;
use App\Models\kriteriamodel;
use App\Models\datanormalisasi_model;
use App\Models\datakeputusan_model;
use App\Models\dataoptimasi_model;

class Home extends BaseController
{
    // public function index(): string
    // {
    //     return view('welcome_message');
    // }
    public function __construct() {
        $this->altermodel = new altermodel(); // Load model
        $this->kriteriamodel = new kriteriamodel(); // Load model
    }
    public function index()
    {
        $data['jumlah_alter'] = $this->altermodel->countalter();
        $data['jumlah_kriteria'] = $this->kriteriamodel->countkriteria();
        echo view('Admin_header');
        echo view('Admin_nav');
        echo view('home', $data);
        echo view('Admin_footer');
    }
    public function callviewoptimasi()
    {
        $optimasi = new dataoptimasi_model();
        $dataopt = $optimasi->tampiloptimasi();
        $data = array('dataopt' => $dataopt);
        echo view('Admin_header');
        echo view('Admin_nav');
        echo view('viewoptimasi', $data);
        echo view('Admin_footer');
    }
    public function callviewnormalisasi(){
        $normalisasi = new datanormalisasi_model();
        $datanorm = $normalisasi->tampilnormalisasi();
        $data = array('datanorm' => $datanorm);
        echo view('Admin_header');
        echo view('Admin_nav');
        echo view('viewnormalisasi', $data);
        echo view('Admin_footer');
    }
    public function callviewhasil(){
        $mb = new datahasiloptimasi_model();
        $datamb = $mb->tampilhasil();
        $data = array('datahasil'=>$datamb);

        echo view('Admin_header');
        echo view('Admin_nav');
        echo view('viewhasilopt', $data);
        echo view('Admin_footer');
    }
    public function callviewkeputusan(){
        $mb = new datahasiloptimasi_model();
        $datamb = $mb->tampilhasil();
        $data = array('datahasil'=>$datamb);

        echo view('Admin_header');
        echo view('Admin_nav');
        echo view('viewkeputusan', $data);
        echo view('Admin_footer');
    }
    
}
