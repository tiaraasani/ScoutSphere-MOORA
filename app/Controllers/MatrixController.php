<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\AlternativeModel;
use App\Models\CriteriaModel;
use App\Models\MatrixModel;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * Maintains the decision matrix: the score of every alternative on every criterion.
 */
class MatrixController extends BaseController
{
    private MatrixModel $matrix;
    private AlternativeModel $alternatives;
    private CriteriaModel $criteria;

    public function __construct()
    {
        $this->matrix       = new MatrixModel();
        $this->alternatives = new AlternativeModel();
        $this->criteria     = new CriteriaModel();
    }

    public function index(): string
    {
        $values = $this->matrix->findAllGrouped();

        $alternatives = array_filter(
            $this->alternatives->findAllOrdered(),
            static fn (object $alternative): bool => isset($values[(int) $alternative->id])
        );

        return $this->render('matriks', [
            'pageTitle'    => 'Matriks Penilaian',
            'pageSubtitle' => 'Nilai setiap peserta pada setiap kriteria. Hanya peserta yang sudah dinilai yang tampil di sini.',
            'breadcrumbs'  => ['Matriks Penilaian' => null],
            'alternatives' => $alternatives,
            'criteria'     => $this->criteria->findAllOrdered(),
            'values'       => $values,
        ]);
    }

    public function create(): string
    {
        return $this->render('forminputmatriks', [
            'pageTitle'    => 'Tambah Penilaian',
            'breadcrumbs'  => ['Matriks Penilaian' => 'matrix', 'Tambah' => null],
            'alternatives' => $this->alternatives->findAllOrdered(),
            'criteria'     => $this->criteria->findAllOrdered(),
        ]);
    }

    public function store(): RedirectResponse
    {
        $criteria = $this->criteria->findAllOrdered();

        $rules = [
            'alternative_id' => ['label' => 'Peserta', 'rules' => 'required|is_natural_no_zero|is_not_unique[alternatif.id]'],
        ] + $this->valueRules($criteria);

        if (! $this->validate($rules)) {
            return $this->validationFailed();
        }

        $alternativeId = (int) $this->request->getPost('alternative_id');

        if ($this->matrix->hasAlternative($alternativeId)) {
            return redirect()->back()->withInput()->with('error', 'Matriks untuk peserta ini sudah ada. Gunakan menu Edit.');
        }

        $this->matrix->saveValues($alternativeId, $this->collectValues($criteria));

        return redirect()->to('matrix')->with('success', 'Data matriks berhasil disimpan.');
    }

    public function edit(int $id): string
    {
        $alternative = $this->findOrFail($this->alternatives, $id);

        return $this->render('formeditmatriks', [
            'pageTitle'   => 'Edit Penilaian',
            'breadcrumbs' => ['Matriks Penilaian' => 'matrix', $alternative->kode => null],
            'alternative' => $alternative,
            'criteria'    => $this->criteria->findAllOrdered(),
            'values'      => $this->matrix->findByAlternative($id),
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        $this->findOrFail($this->alternatives, $id);

        $criteria = $this->criteria->findAllOrdered();

        if (! $this->validate($this->valueRules($criteria))) {
            return $this->validationFailed();
        }

        $this->matrix->saveValues($id, $this->collectValues($criteria));

        return redirect()->to('matrix')->with('success', 'Data matriks berhasil diperbarui.');
    }

    public function delete(int $id): RedirectResponse
    {
        $this->findOrFail($this->alternatives, $id);
        $this->matrix->deleteByAlternative($id);

        return redirect()->to('matrix')->with('success', 'Data matriks berhasil dihapus.');
    }

    /**
     * One required numeric rule per criterion, keyed as `values.{criterion id}`.
     *
     * @param list<object> $criteria
     *
     * @return array<string, array{label: string, rules: string}>
     */
    private function valueRules(array $criteria): array
    {
        $rules = [];

        foreach ($criteria as $criterion) {
            $rules['values.' . $criterion->id] = [
                'label' => 'Nilai ' . $criterion->kriteria,
                'rules' => 'required|decimal|greater_than_equal_to[0]',
            ];
        }

        return $rules;
    }

    /**
     * Reads the validated values from the request, keyed by criterion id.
     *
     * @param list<object> $criteria
     *
     * @return array<int, string>
     */
    private function collectValues(array $criteria): array
    {
        $posted = (array) $this->request->getPost('values');
        $values = [];

        foreach ($criteria as $criterion) {
            $values[(int) $criterion->id] = (string) $posted[$criterion->id];
        }

        return $values;
    }
}
