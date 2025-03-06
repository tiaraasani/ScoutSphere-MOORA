<?php

namespace App\Controllers;

use App\Models\altermodel;
use App\Models\kriteriamodel;
use App\Models\matriksmodel;

class matrikscontroller extends BaseController
{
    protected $matriksmodel;
    public function __construct()
    {
        $this->matriksmodel = new matriksmodel();
    }
    public function viewmatriks()
    {
        $kriteria = new kriteriamodel();
        $matriks = new matriksmodel();
        $alternatif = new altermodel();

        $datamatriks = $matriks->tampildata();
        $datakriteria = $kriteria->tampildata();
        $dataalternatif = $alternatif->tampildata();
        $data = [
            'datamatriks' => $datamatriks,
            'kriteria'    => $datakriteria,
            'alternatif'    => $dataalternatif,
        ];
        echo view('Admin_header');
        echo view('Admin_nav');
        echo view('matriks', $data);
        echo view('Admin_footer');
    }
    public function inputmatriks()
    {
        $kriteria = new kriteriamodel();
        $matriks = new matriksmodel();
        $alternatif = new altermodel();

        $datamatriks = $matriks->tampildata();
        $datakriteria = $kriteria->tampildata();
        $dataalternatif = $alternatif->tampildata();
        $data = [
            'datamatriks' => $datamatriks,
            'kriteria'    => $datakriteria,
            'alternatif'    => $dataalternatif,
        ];
        echo view('Admin_header');
        echo view('Admin_nav');
        echo view('forminputmatriks', $data);
        echo view('Admin_footer');
    }
    public function simpanmatriks()
    {
        $kode_peserta = $this->request->getPost('kode_peserta');
        $matriksModel = new matriksmodel();
        $kriteria = new kriteriamodel();
        $datakriteria = $kriteria->tampildata();

        // Menyimpan nilai matriks untuk setiap kriteria
        foreach ($datakriteria as $krit) {
            $nilaiKriteria = $this->request->getPost('C' . $krit->id);
            $dataMatriks = [
                'id_peserta'   => $kode_peserta, // ID Peserta
                'id_kriteria'  => $krit->id,     // ID Kriteria
                'nilai'        => $nilaiKriteria, // Nilai untuk matriks
            ];
            $matriksModel->simpanmatriks('matriks', $dataMatriks);
        }
        return redirect()->to(site_url('datamatriks/view'))->with('success', 'Data matriks berhasil disimpan.');
    }


    public function formeditmatriks($id)
    {
        $matriks = new matriksmodel();
        $kriteria = new kriteriamodel();
        $alternatif = new altermodel();

        $datamatriks = $matriks->getmatriksid($id);
        $datakriteria = $kriteria->tampildata();
        $dataalternatif = $alternatif->tampildata();

        $data = [
            'datamatriks' => $datamatriks,
            'kriteria' => $datakriteria,
            'alternatif' => $dataalternatif,
            'idPeserta' => $id, 
        ];

        echo view('Admin_header');
        echo view('Admin_nav');
        echo view('formeditmatriks', $data);
        echo view('Admin_footer');
    }


    public function editmatriks($id)
    {
        $matriksModel = new matriksmodel();
        $postData = $this->request->getPost();

        foreach ($postData as $key => $value) {
            if (strpos($key, 'C') === 0) {
                $idKriteria = substr($key, 1);
                $existingData = $matriksModel->where([
                    'id_peserta'  => $id,
                    'id_kriteria' => $idKriteria
                ])->first();

                if ($existingData) {
                    $data = [
                        'nilai' => $value
                    ];
                    $where = [
                        'id_peserta'  => $id,
                        'id_kriteria' => $idKriteria
                    ];

                    $matriksModel->proseseditmatriks('matriks', $data, $where);
                } else {
                    $data = [
                        'id_peserta'  => $id,
                        'id_kriteria' => $idKriteria,
                        'nilai'       => $value
                    ];

                    $matriksModel->insert($data);
                }
            }
        }

        return redirect()->to(site_url('datamatriks/view'))->with('success', 'Data matriks berhasil diperbarui.');
    }


    public function hapusmatriks($idPeserta)
    {
        $matriks = new matriksmodel();
        $matriks->hapusmatriks('matriks', ['id_peserta' => $idPeserta]);

        return redirect()->to(site_url('datamatriks/view'));
    }
}
