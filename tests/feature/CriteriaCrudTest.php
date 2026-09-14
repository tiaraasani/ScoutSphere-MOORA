<?php

declare(strict_types=1);

namespace Tests\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Database\Seeds\TestDataSeeder;

/**
 * @internal
 */
final class CriteriaCrudTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $namespace = 'Tests\Support';
    protected $seed      = TestDataSeeder::class;

    public function testIndexShowsTypeBadges(): void
    {
        $response = $this->asAdmin()->get('criteria');

        $response->assertOK();
        $response->assertSee('Prestasi');
        $response->assertSee('Benefit');
        $response->assertSee('Cost');
    }

    public function testStoreRejectsUnknownTypeAndNonNumericWeight(): void
    {
        $response = $this->asAdmin()->post('criteria', [
            csrf_token() => csrf_hash(),
            'kriteria'   => 'C3',
            'nama'       => 'Kehadiran',
            'bobot'      => 'banyak',
            'jenis'      => 'netral',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('errors');
        $this->assertArrayHasKey('bobot', session('errors'));
        $this->assertArrayHasKey('jenis', session('errors'));
        $this->dontSeeInDatabase('kriteria', ['kriteria' => 'C3']);
    }

    public function testStoreAcceptsValidCriterion(): void
    {
        $response = $this->asAdmin()->post('criteria', [
            csrf_token() => csrf_hash(),
            'kriteria'   => 'C3',
            'nama'       => 'Kehadiran',
            'bobot'      => '0.25',
            'jenis'      => 'benefit',
        ]);

        $response->assertRedirectTo('criteria');
        $this->seeInDatabase('kriteria', ['kriteria' => 'C3', 'nama' => 'Kehadiran', 'jenis' => 'benefit']);
    }

    public function testUpdateKeepsCodeButChangesEditableFields(): void
    {
        $response = $this->asAdmin()->post('criteria/2/update', [
            csrf_token() => csrf_hash(),
            'nama'       => 'Jumlah Pelanggaran',
            'bobot'      => '0.5',
            'jenis'      => 'cost',
        ]);

        $response->assertRedirectTo('criteria');
        $this->seeInDatabase('kriteria', ['id' => 2, 'kriteria' => 'C2', 'nama' => 'Jumlah Pelanggaran']);
    }

    public function testDeleteRemovesCriterionAndItsMatrixColumn(): void
    {
        $this->seeInDatabase('matriks', ['id_kriteria' => 1]);

        $response = $this->asAdmin()->post('criteria/1/delete', [csrf_token() => csrf_hash()]);

        $response->assertRedirectTo('criteria');
        $this->dontSeeInDatabase('kriteria', ['id' => 1]);
        $this->dontSeeInDatabase('matriks', ['id_kriteria' => 1]);
        $this->seeInDatabase('matriks', ['id_kriteria' => 2]);
    }

    private function asAdmin(): self
    {
        return $this->withSession(['logged_in' => true, 'user_id' => 1, 'username' => TestDataSeeder::ADMIN_USERNAME]);
    }
}
