<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

/**
 * Decision matrix: one row per (alternative, criterion) pair.
 *
 * Table: matriks (id, id_peserta, id_kriteria, nilai)
 */
class MatrixModel extends Model
{
    protected $table         = 'matriks';
    protected $primaryKey    = 'id';
    protected $returnType    = 'object';
    protected $allowedFields = ['id_peserta', 'id_kriteria', 'nilai'];

    /**
     * Returns all values keyed by alternative id, then criterion id.
     *
     * @return array<int, array<int, string>>
     */
    public function findAllGrouped(): array
    {
        $grouped = [];

        foreach ($this->findAll() as $row) {
            $grouped[(int) $row->id_peserta][(int) $row->id_kriteria] = $row->nilai;
        }

        return $grouped;
    }

    /**
     * Returns the values of one alternative keyed by criterion id.
     *
     * @return array<int, string>
     */
    public function findByAlternative(int $alternativeId): array
    {
        $values = [];

        foreach ($this->where('id_peserta', $alternativeId)->findAll() as $row) {
            $values[(int) $row->id_kriteria] = $row->nilai;
        }

        return $values;
    }

    public function hasAlternative(int $alternativeId): bool
    {
        return $this->where('id_peserta', $alternativeId)->countAllResults() > 0;
    }

    /**
     * Inserts or updates the value of every criterion for one alternative
     * inside a single transaction.
     *
     * @param array<int, string> $values criterion id => value
     */
    public function saveValues(int $alternativeId, array $values): bool
    {
        $this->db->transStart();

        foreach ($values as $criterionId => $value) {
            $existing = $this->where([
                'id_peserta'  => $alternativeId,
                'id_kriteria' => $criterionId,
            ])->first();

            if ($existing === null) {
                $this->insert([
                    'id_peserta'  => $alternativeId,
                    'id_kriteria' => $criterionId,
                    'nilai'       => $value,
                ]);
            } else {
                $this->update($existing->id, ['nilai' => $value]);
            }
        }

        $this->db->transComplete();

        return $this->db->transStatus();
    }

    public function deleteByAlternative(int $alternativeId): bool
    {
        return $this->where('id_peserta', $alternativeId)->delete() !== false;
    }

    public function deleteByCriterion(int $criterionId): bool
    {
        return $this->where('id_kriteria', $criterionId)->delete() !== false;
    }

    /**
     * Number of alternatives that have at least one matrix value.
     */
    public function countAlternatives(): int
    {
        $row = $this->builder()
            ->select('COUNT(DISTINCT id_peserta) AS total')
            ->get()
            ->getRow();

        return (int) ($row->total ?? 0);
    }
}
