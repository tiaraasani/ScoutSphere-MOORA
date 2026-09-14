<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\AlternativeModel;
use App\Models\MatrixModel;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * CRUD for alternatives (the scout participants being ranked).
 */
class AlternativeController extends BaseController
{
    private AlternativeModel $alternatives;
    private MatrixModel $matrix;

    public function __construct()
    {
        $this->alternatives = new AlternativeModel();
        $this->matrix       = new MatrixModel();
    }

    public function index(): string
    {
        return $this->render('dataalter', [
            'pageTitle'    => 'Data Peserta',
            'pageSubtitle' => 'Daftar alternatif yang akan dinilai dan diperingkatkan.',
            'breadcrumbs'  => ['Data Peserta' => null],
            'alternatives' => $this->alternatives->findAllOrdered(),
        ]);
    }

    public function create(): string
    {
        return $this->render('forminputalter', [
            'pageTitle'   => 'Tambah Peserta',
            'breadcrumbs' => ['Data Peserta' => 'alternatives', 'Tambah' => null],
        ]);
    }

    public function store(): RedirectResponse
    {
        $rules = [
            'kode' => ['label' => 'Kode Peserta', 'rules' => 'required|alpha_dash|max_length[20]|is_unique[alternatif.kode]'],
            'nama' => ['label' => 'Nama Peserta', 'rules' => 'required|string|max_length[100]'],
        ];

        if (! $this->validate($rules)) {
            return $this->validationFailed();
        }

        $this->alternatives->insert([
            'kode' => $this->request->getPost('kode'),
            'nama' => $this->request->getPost('nama'),
        ]);

        return redirect()->to('alternatives')->with('success', 'Data peserta berhasil disimpan.');
    }

    public function edit(int $id): string
    {
        $alternative = $this->findOrFail($this->alternatives, $id);

        return $this->render('formeditalter', [
            'pageTitle'   => 'Edit Peserta',
            'breadcrumbs' => ['Data Peserta' => 'alternatives', $alternative->kode => null],
            'alternative' => $alternative,
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        $this->findOrFail($this->alternatives, $id);

        $rules = [
            'nama' => ['label' => 'Nama Peserta', 'rules' => 'required|string|max_length[100]'],
        ];

        if (! $this->validate($rules)) {
            return $this->validationFailed();
        }

        $this->alternatives->update($id, [
            'nama' => $this->request->getPost('nama'),
        ]);

        return redirect()->to('alternatives')->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function delete(int $id): RedirectResponse
    {
        $this->findOrFail($this->alternatives, $id);

        $db = db_connect();
        $db->transStart();
        $this->matrix->deleteByAlternative($id);
        $this->alternatives->delete($id);
        $db->transComplete();

        return redirect()->to('alternatives')->with('success', 'Data peserta berhasil dihapus.');
    }
}
