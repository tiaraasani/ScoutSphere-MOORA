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
final class AuthenticationTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $namespace = 'Tests\Support';
    protected $seed      = TestDataSeeder::class;

    public function testGuestIsRedirectedToLogin(): void
    {
        $this->get('/')->assertRedirectTo('login');
    }

    public function testGuestCannotReachProtectedPages(): void
    {
        $this->get('alternatives')->assertRedirectTo('login');
        $this->get('criteria')->assertRedirectTo('login');
        $this->get('matrix')->assertRedirectTo('login');
        $this->get('results/decision')->assertRedirectTo('login');
    }

    public function testLoginPageIsPublicAndCarriesCsrfToken(): void
    {
        $response = $this->get('login');

        $response->assertOK();
        $response->assertSee('Masuk');
        $response->assertSee(csrf_token());
    }

    public function testLoggedInUserIsSentAwayFromLoginPage(): void
    {
        $this->withSession($this->adminSession())
            ->get('login')
            ->assertRedirectTo('/');
    }

    public function testWrongPasswordIsRejectedWithoutRevealingWhy(): void
    {
        $response = $this->post('login', [
            csrf_token() => csrf_hash(),
            'username'   => TestDataSeeder::ADMIN_USERNAME,
            'password'   => 'bukan-password-yang-benar',
        ]);

        $response->assertRedirectTo('login');
        $response->assertSessionHas('error', 'Username atau password salah.');
        $response->assertSessionMissing('logged_in');
    }

    public function testUnknownUsernameGetsTheSameMessage(): void
    {
        $response = $this->post('login', [
            csrf_token() => csrf_hash(),
            'username'   => 'tidak-ada',
            'password'   => TestDataSeeder::ADMIN_PASSWORD,
        ]);

        $response->assertRedirectTo('login');
        $response->assertSessionHas('error', 'Username atau password salah.');
    }

    public function testValidCredentialsStartASession(): void
    {
        $response = $this->post('login', [
            csrf_token() => csrf_hash(),
            'username'   => TestDataSeeder::ADMIN_USERNAME,
            'password'   => TestDataSeeder::ADMIN_PASSWORD,
        ]);

        $response->assertRedirectTo('/');
        $response->assertSessionHas('logged_in', true);
        $response->assertSessionHas('username', TestDataSeeder::ADMIN_USERNAME);
    }

    public function testLogoutRedirectsToLoginPage(): void
    {
        // Session::destroy() is a deliberate no-op in the testing environment,
        // so the observable outcome here is the redirect, not the emptied session.
        $this->withSession($this->adminSession())
            ->post('logout', [csrf_token() => csrf_hash()])
            ->assertRedirectTo('login');
    }

    /**
     * @return array<string, mixed>
     */
    private function adminSession(): array
    {
        return ['logged_in' => true, 'user_id' => 1, 'username' => TestDataSeeder::ADMIN_USERNAME];
    }
}
