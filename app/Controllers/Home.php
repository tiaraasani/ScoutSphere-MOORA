<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\AlternativeModel;
use App\Models\CriteriaModel;
use App\Models\MatrixModel;
use App\Models\NormalizationModel;
use App\Models\ResultModel;
use App\Models\WeightedNormalizationModel;

/**
 * Dashboard and MOORA calculation result pages.
 */
class Home extends BaseController
{
    private const DASHBOARD_TOP_RESULTS = 3;

    public function index(): string
    {
        return $this->render('Home', [
            'pageTitle'        => 'Dashboard',
            'pageSubtitle'     => 'Ringkasan data penilaian Pandega Berprestasi wilayah Kalimantan Timur.',
            'alternativeCount' => (new AlternativeModel())->countAll(),
            'criteriaCount'    => (new CriteriaModel())->countAll(),
            'matrixCount'      => (new MatrixModel())->countAlternatives(),
            'topResults'       => array_slice((new ResultModel())->findRanked(), 0, self::DASHBOARD_TOP_RESULTS),
        ]);
    }

    public function normalization(): string
    {
        return $this->render('viewnormalisasi', [
            'pageTitle'    => 'Hasil Normalisasi',
            'pageSubtitle' => 'Langkah 1 MOORA: setiap nilai dibagi akar jumlah kuadrat nilai pada kriteria yang sama.',
            'breadcrumbs'  => ['Perhitungan' => null, 'Normalisasi' => null],
            'rows'         => (new NormalizationModel())->findAll(),
        ]);
    }

    public function weightedNormalization(): string
    {
        return $this->render('viewoptimasi', [
            'pageTitle'    => 'Normalisasi Berbobot',
            'pageSubtitle' => 'Langkah 2 MOORA: nilai ternormalisasi dikalikan bobot kriteria.',
            'breadcrumbs'  => ['Perhitungan' => null, 'Normalisasi Berbobot' => null],
            'rows'         => (new WeightedNormalizationModel())->findAll(),
        ]);
    }

    public function optimization(): string
    {
        return $this->render('viewhasilopt', [
            'pageTitle'    => 'Hasil Optimasi',
            'pageSubtitle' => 'Langkah 3 MOORA: jumlah kriteria benefit dikurangi jumlah kriteria cost.',
            'breadcrumbs'  => ['Perhitungan' => null, 'Optimasi' => null],
            'rows'         => (new ResultModel())->findRanked(),
        ]);
    }

    public function decision(): string
    {
        return $this->render('viewkeputusan', [
            'pageTitle'    => 'Hasil Keputusan',
            'pageSubtitle' => 'Peringkat akhir peserta berdasarkan skor preferensi MOORA.',
            'breadcrumbs'  => ['Perhitungan' => null, 'Keputusan' => null],
            'rows'         => (new ResultModel())->findRanked(),
        ]);
    }
}
