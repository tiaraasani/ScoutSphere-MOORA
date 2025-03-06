<?php

namespace App\Controllers;

use App\Models\MatriksKeputusanModel;
use App\Models\KriteriaModel;
use App\Models\PengajarModel;
use App\Models\skalaModel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MatrikskeputusanController extends BaseController
{
    protected $matriksModel;
    protected $kriteriaModel;
    protected $pengajarModel;
    protected $skalaModel;

    public function __construct()
    {
        $this->matriksModel = new MatriksKeputusanModel();
        $this->kriteriaModel = new KriteriaModel();
        $this->pengajarModel = new PengajarModel();
        $this->skalaModel = new SkalaModel();
    }

    public function index()
    {
        $kriteria = $this->kriteriaModel->findAll();
        $pengajar = $this->pengajarModel->findAll();

        $matriks = $this->matriksModel
            ->select('matrikskeputusan.*, skala.keterangan as skala_value, kriteria.id as kriteria_id, kriteria.namakriteria, pengajar.nama as pengajar_name')
            ->join('pengajar', 'pengajar.id = matrikskeputusan.idpengajar')
            ->join('kriteria', 'kriteria.id = matrikskeputusan.idkriteria')
            ->join('skala', 'skala.id = matrikskeputusan.idskala', 'left')
            ->orderBy('idpengajar, idkriteria')
            ->findAll();

        $dataByPengajar = [];
        foreach ($matriks as $row) {
            $dataByPengajar[$row['idpengajar']]['nama'] = $row['pengajar_name'];
            $dataByPengajar[$row['idpengajar']]['data'][$row['idkriteria']] = $row['skala_value'] ?? '-';
        }

        $skalaOptions = $this->skalaModel->findAll();

        $data = [
            'kriteria' => $kriteria,
            'pengajar' => $pengajar,
            'dataByPengajar' => $dataByPengajar,
            'skalaOptions' => $skalaOptions,
        ];

        echo view('master');
        echo view('matrikskeputusan', $data);
    }
    public function index2()
    {
        $kriteria = $this->kriteriaModel->findAll();
        $pengajar = $this->pengajarModel->findAll();

        $matriks = $this->matriksModel
            ->select('matrikskeputusan.*, skala.value as skala_value, kriteria.id as kriteria_id, kriteria.namakriteria, pengajar.nama as pengajar_name')
            ->join('pengajar', 'pengajar.id = matrikskeputusan.idpengajar')
            ->join('kriteria', 'kriteria.id = matrikskeputusan.idkriteria')
            ->join('skala', 'skala.id = matrikskeputusan.idskala', 'left')
            ->orderBy('idpengajar, idkriteria')
            ->findAll();

        $dataByPengajar = [];
        foreach ($matriks as $row) {
            $dataByPengajar[$row['idpengajar']]['nama'] = $row['pengajar_name'];
            $dataByPengajar[$row['idpengajar']]['data'][$row['idkriteria']] = $row['skala_value'] ?? '-';
        }

        $skalaOptions = $this->skalaModel->findAll();

        $data = [
            'kriteria' => $kriteria,
            'pengajar' => $pengajar,
            'dataByPengajar' => $dataByPengajar,
            'skalaOptions' => $skalaOptions,
        ];

        echo view('master');
        echo view('matrikskeputusanangka', $data);
    }

    public function save()
    {
        $idPengajar = $this->request->getPost('idpengajar');
        $criteria = $this->request->getPost('kriteria');

        foreach ($criteria as $idKriteria => $idSkala) {
            $existingRecord = $this->matriksModel
                ->where('idpengajar', $idPengajar)
                ->where('idkriteria', $idKriteria)
                ->first();

            if ($existingRecord) {
                $this->matriksModel->update($existingRecord['id'], [
                    'idskala' => $idSkala,
                ]);
            } else {
                $this->matriksModel->insert([
                    'idpengajar' => $idPengajar,
                    'idkriteria' => $idKriteria,
                    'idskala' => $idSkala,
                ]);
            }
        }

        return redirect()->to('/matrikskeputusan');
    }

    public function delete($idPengajar)
    {
        $this->matriksModel->where('idpengajar', $idPengajar)->delete();
        return redirect()->to('/matrikskeputusan');
    }

}