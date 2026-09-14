<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\CriteriaModel;
use App\Models\MatrixModel;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * CRUD for the criteria used to score alternatives.
 */
class CriteriaController extends BaseController
{
    private CriteriaModel $criteria;
    private MatrixModel $matrix;

    public function __construct()
    {
        $this->criteria = new CriteriaModel();
        $this->matrix   = new MatrixModel();
    }

    public function index(): string
    {
        return $this->render('kriteria', [
            'pageTitle'    => 'Data Kriteria',
            'pageSubtitle' => 'Kriteria penilaian beserta bobot dan jenisnya (benefit dimaksimalkan, cost diminimalkan).',
            'breadcrumbs'  => ['Data Kriteria' => null],
            'criteria'     => $this->criteria->findAllOrdered(),
        ]);
    }

    public function create(): string
    {
        return $this->render('forminputkriteria', [
            'pageTitle'   => 'Tambah Kriteria',
            'breadcrumbs' => ['Data Kriteria' => 'criteria', 'Tambah' => null],
            'types'       => CriteriaModel::TYPES,
        ]);
    }

    public function store(): RedirectResponse
    {
        $rules = [
            'kriteria' => ['label' => 'Kode Kriteria', 'rules' => 'required|alpha_dash|max_length[10]|is_unique[kriteria.kriteria]'],
        ] + $this->editableRules();

        if (! $this->validate($rules)) {
            return $this->validationFailed();
        }

        $this->criteria->insert([
            'kriteria' => $this->request->getPost('kriteria'),
            'nama'     => $this->request->getPost('nama'),
            'bobot'    => $this->request->getPost('bobot'),
            'jenis'    => $this->request->getPost('jenis'),
        ]);

        return redirect()->to('criteria')->with('success', 'Data kriteria berhasil disimpan.');
    }

    public function edit(int $id): string
    {
        $criterion = $this->findOrFail($this->criteria, $id);

        return $this->render('formeditkriteria', [
            'pageTitle'   => 'Edit Kriteria',
            'breadcrumbs' => ['Data Kriteria' => 'criteria', $criterion->kriteria => null],
            'criterion'   => $criterion,
            'types'       => CriteriaModel::TYPES,
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        $this->findOrFail($this->criteria, $id);

        if (! $this->validate($this->editableRules())) {
            return $this->validationFailed();
        }

        $this->criteria->update($id, [
            'nama'  => $this->request->getPost('nama'),
            'bobot' => $this->request->getPost('bobot'),
            'jenis' => $this->request->getPost('jenis'),
        ]);

        return redirect()->to('criteria')->with('success', 'Data kriteria berhasil diperbarui.');
    }

    public function delete(int $id): RedirectResponse
    {
        $this->findOrFail($this->criteria, $id);

        $db = db_connect();
        $db->transStart();
        $this->matrix->deleteByCriterion($id);
        $this->criteria->delete($id);
        $db->transComplete();

        return redirect()->to('criteria')->with('success', 'Data kriteria berhasil dihapus.');
    }

    /**
     * Validation rules for the fields that can be changed after creation.
     *
     * @return array<string, array{label: string, rules: string}>
     */
    private function editableRules(): array
    {
        return [
            'nama'  => ['label' => 'Nama Kriteria', 'rules' => 'required|string|max_length[100]'],
            'bobot' => ['label' => 'Bobot', 'rules' => 'required|decimal|greater_than[0]'],
            'jenis' => ['label' => 'Jenis Kriteria', 'rules' => 'required|in_list[' . implode(',', CriteriaModel::TYPES) . ']'],
        ];
    }
}
