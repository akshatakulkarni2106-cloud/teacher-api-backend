<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthController extends BaseController
{
    // POST /api/register
    public function register()
    {
        $json = $this->request->getJSON();

        if (!$json) {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Invalid JSON']);
        }

        $email      = $json->email ?? '';
        $first_name = $json->first_name ?? '';
        $last_name  = $json->last_name ?? '';
        $password   = $json->password ?? '';

        if (!$email || !$first_name || !$last_name || !$password) {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'All fields are required']);
        }

        $db = \Config\Database::connect();

        // Check if email already exists
        $existing = $db->table('auth_user')->where('email', $email)->get()->getRow();
        if ($existing) {
            return $this->response->setStatusCode(409)->setJSON(['message' => 'Email already registered']);
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $db->table('auth_user')->insert([
            'email'      => $email,
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'password'   => $hashedPassword,
        ]);

        return $this->response->setStatusCode(201)->setJSON(['message' => 'User registered successfully']);
    }

    // POST /api/login
    public function login()
    {
        $json = $this->request->getJSON();

        $email    = $json->email ?? '';
        $password = $json->password ?? '';

        if (!$email || !$password) {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Email and password required']);
        }

        $db   = \Config\Database::connect();
        $user = $db->table('auth_user')->where('email', $email)->get()->getRow();

        if (!$user || !password_verify($password, $user->password)) {
            return $this->response->setStatusCode(401)->setJSON(['message' => 'Invalid credentials']);
        }

        // Generate token
        $token = bin2hex(random_bytes(32));

        // Save token to DB
        $db->table('auth_user')->where('id', $user->id)->update(['token' => $token]);

        return $this->response->setStatusCode(200)->setJSON([
            'message' => 'Login successful',
            'token'   => $token,
            'user'    => [
                'id'         => $user->id,
                'email'      => $user->email,
                'first_name' => $user->first_name,
                'last_name'  => $user->last_name,
            ]
        ]);
    }

    // GET /api/users (protected)
    public function index()
    {
        $db    = \Config\Database::connect();
        $users = $db->table('auth_user')->select('id, email, first_name, last_name, created_at')->get()->getResultArray();

        return $this->response->setStatusCode(200)->setJSON(['users' => $users]);
    }
}