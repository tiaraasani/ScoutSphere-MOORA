<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * Session-based login and logout.
 */
class AuthController extends BaseController
{
    private const FAILED_MESSAGE = 'Username atau password salah.';

    /**
     * A valid bcrypt hash that matches no real password. It is verified
     * when the username does not exist so that the response time does not
     * reveal whether an account exists.
     */
    private const DUMMY_HASH = '$2y$10$pgDCoB0sx/WMkIpRevoAXedCC72FRbY9Oru80lV/PueTqRQkL6YmK';

    public function login(): string|RedirectResponse
    {
        if (session()->get('logged_in') === true) {
            return redirect()->to('/');
        }

        return view('login');
    }

    public function attempt(): RedirectResponse
    {
        $rules = [
            'username' => ['label' => 'Username', 'rules' => 'required|alpha_dash|max_length[50]'],
            'password' => ['label' => 'Password', 'rules' => 'required|max_length[255]'],
        ];

        if (! $this->validate($rules)) {
            return $this->failed();
        }

        $user = (new UserModel())->findByUsername((string) $this->request->getPost('username'));
        $hash = $user['password_hash'] ?? self::DUMMY_HASH;

        if (! password_verify((string) $this->request->getPost('password'), $hash) || $user === null) {
            return $this->failed();
        }

        session()->regenerate(true);
        session()->set([
            'logged_in' => true,
            'user_id'   => (int) $user['id'],
            'username'  => $user['username'],
        ]);

        return redirect()->to('/');
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();

        return redirect()->to('login');
    }

    private function failed(): RedirectResponse
    {
        return redirect()->to('login')->withInput()->with('error', self::FAILED_MESSAGE);
    }
}
