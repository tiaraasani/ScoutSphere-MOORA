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
final class MatrixTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $namespace = 'Tests\Support';
    protected $seed      = TestDataSeeder::class;

    public function testIndexListsOnlyParticipantsThatHaveScores(): void
    {
        $response = $this->asAdmin()->get('matrix');

        $response->assertOK();
        $response->assertSee('Andi Saputra');
        $response->assertDontSee('Budi Santoso');
    }

    public function testStoreRejectsParticipantThatIsAlreadyScored(): void
    {
        $response = $this->asAdmin()->post('matrix', [
            csrf_token()     => csrf_hash(),
            'alternative_id' => 1,
            'values'         => [1 => '50', 2 => '1'],
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->seeInDatabase('matriks', ['id_peserta' => 1, 'id_kriteria' => 1, 'nilai' => 80]);
    }

    public function testStoreRequiresEveryCriterionValue(): void
    {
        $response = $this->asAdmin()->post('matrix', [
            csrf_token()     => csrf_hash(),
            'alternative_id' => 2,
            'values'         => [1 => '70'],
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('errors');
        $this->assertArrayHasKey('values.2', session('errors'));
        $this->dontSeeInDatabase('matriks', ['id_peserta' => 2]);
    }

    public function testStoreSavesOneRowPerCriterion(): void
    {
        $response = $this->asAdmin()->post('matrix', [
            csrf_token()     => csrf_hash(),
            'alternative_id' => 2,
            'values'         => [1 => '70', 2 => '0'],
        ]);

        $response->assertRedirectTo('matrix');
        $this->seeInDatabase('matriks', ['id_peserta' => 2, 'id_kriteria' => 1, 'nilai' => 70]);
        $this->seeInDatabase('matriks', ['id_peserta' => 2, 'id_kriteria' => 2, 'nilai' => 0]);
        $this->seeNumRecords(2, 'matriks', ['id_peserta' => 2]);
    }

    public function testUpdateOverwritesExistingValuesWithoutDuplicating(): void
    {
        $response = $this->asAdmin()->post('matrix/1/update', [
            csrf_token() => csrf_hash(),
            'values'     => [1 => '95', 2 => '3'],
        ]);

        $response->assertRedirectTo('matrix');
        $this->seeInDatabase('matriks', ['id_peserta' => 1, 'id_kriteria' => 1, 'nilai' => 95]);
        $this->seeInDatabase('matriks', ['id_peserta' => 1, 'id_kriteria' => 2, 'nilai' => 3]);
        $this->seeNumRecords(2, 'matriks', ['id_peserta' => 1]);
    }

    public function testDeleteRemovesAllScoresOfOneParticipant(): void
    {
        $response = $this->asAdmin()->post('matrix/1/delete', [csrf_token() => csrf_hash()]);

        $response->assertRedirectTo('matrix');
        $this->dontSeeInDatabase('matriks', ['id_peserta' => 1]);
        $this->seeInDatabase('alternatif', ['id' => 1]);
    }

    private function asAdmin(): self
    {
        return $this->withSession(['logged_in' => true, 'user_id' => 1, 'username' => TestDataSeeder::ADMIN_USERNAME]);
    }
}
