<?php

declare(strict_types=1);

namespace Tests\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use Config\Services;
use Tests\Support\Database\Seeds\TestDataSeeder;

/**
 * @internal
 */
final class RateLimitTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    private const LOGIN_ATTEMPTS_PER_MINUTE = 5;

    protected $namespace = 'Tests\Support';
    protected $seed      = TestDataSeeder::class;

    protected function setUp(): void
    {
        parent::setUp();

        $this->resetThrottleBuckets();
    }

    protected function tearDown(): void
    {
        $this->resetThrottleBuckets();

        parent::tearDown();
    }

    /**
     * The harness injects a fresh mock cache per test, but the shared throttler
     * service keeps a reference to the cache it was first built with. Rebuilding
     * the service makes every test start with empty buckets.
     */
    private function resetThrottleBuckets(): void
    {
        Services::resetSingle('throttler');
        cache()->clean();
    }

    public function testLoginIsBlockedAfterTooManyAttempts(): void
    {
        for ($attempt = 1; $attempt <= self::LOGIN_ATTEMPTS_PER_MINUTE; $attempt++) {
            $response = $this->post('login', [
                csrf_token() => csrf_hash(),
                'username'   => TestDataSeeder::ADMIN_USERNAME,
                'password'   => 'salah-' . $attempt,
            ]);

            $response->assertRedirectTo('login');
        }

        $blocked = $this->post('login', [
            csrf_token() => csrf_hash(),
            'username'   => TestDataSeeder::ADMIN_USERNAME,
            'password'   => TestDataSeeder::ADMIN_PASSWORD,
        ]);

        $blocked->assertStatus(429);
        $blocked->assertSessionMissing('logged_in');
    }

    public function testThrottleDoesNotAffectOtherPaths(): void
    {
        for ($attempt = 1; $attempt <= self::LOGIN_ATTEMPTS_PER_MINUTE + 1; $attempt++) {
            $this->post('login', [
                csrf_token() => csrf_hash(),
                'username'   => TestDataSeeder::ADMIN_USERNAME,
                'password'   => 'salah',
            ]);
        }

        $this->get('login')->assertOK();
    }
}
