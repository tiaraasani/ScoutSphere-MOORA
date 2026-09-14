<?php

declare(strict_types=1);

namespace Tests\Feature;

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Database\Seeds\TestDataSeeder;

/**
 * @internal
 */
final class AlternativeCrudTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $namespace = 'Tests\Support';
    protected $seed      = TestDataSeeder::class;

    public function testIndexListsSeededParticipants(): void
    {
        $response = $this->asAdmin()->get('alternatives');

        $response->assertOK();
        $response->assertSee('Andi Saputra');
        $response->assertSee('Budi Santoso');
    }

    public function testEditingAnUnknownIdIsNotFound(): void
    {
        $this->expectException(PageNotFoundException::class);

        $this->asAdmin()->get('alternatives/999/edit');
    }

    public function testStoreRejectsDuplicateCodeAndEmptyName(): void
    {
        $response = $this->asAdmin()->post('alternatives', [
            csrf_token() => csrf_hash(),
            'kode'       => 'A01',
            'nama'       => '',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('errors');
        $this->assertArrayHasKey('kode', session('errors'));
        $this->assertArrayHasKey('nama', session('errors'));
        $this->seeNumRecords(2, 'alternatif', []);
    }

    public function testStoreCreatesParticipant(): void
    {
        $response = $this->asAdmin()->post('alternatives', [
            csrf_token() => csrf_hash(),
            'kode'       => 'A03',
            'nama'       => 'Citra Lestari',
        ]);

        $response->assertRedirectTo('alternatives');
        $response->assertSessionHas('success');
        $this->seeInDatabase('alternatif', ['kode' => 'A03', 'nama' => 'Citra Lestari']);
    }

    public function testUpdateChangesNameOnly(): void
    {
        $response = $this->asAdmin()->post('alternatives/1/update', [
            csrf_token() => csrf_hash(),
            'nama'       => 'Andi Saputra Wijaya',
        ]);

        $response->assertRedirectTo('alternatives');
        $this->seeInDatabase('alternatif', ['id' => 1, 'kode' => 'A01', 'nama' => 'Andi Saputra Wijaya']);
    }

    public function testDeleteRemovesParticipantAndItsMatrixRows(): void
    {
        $this->seeInDatabase('matriks', ['id_peserta' => 1]);

        $response = $this->asAdmin()->post('alternatives/1/delete', [csrf_token() => csrf_hash()]);

        $response->assertRedirectTo('alternatives');
        $this->dontSeeInDatabase('alternatif', ['id' => 1]);
        $this->dontSeeInDatabase('matriks', ['id_peserta' => 1]);
        $this->seeInDatabase('alternatif', ['id' => 2]);
    }

    private function asAdmin(): self
    {
        return $this->withSession(['logged_in' => true, 'user_id' => 1, 'username' => TestDataSeeder::ADMIN_USERNAME]);
    }
}
