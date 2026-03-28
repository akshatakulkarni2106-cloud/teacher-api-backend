<?php

namespace App\Controllers;

class TeacherController extends BaseController
{
    // Helper to verify token
    private function verifyToken()
    {
        $authHeader = $this->request->getHeaderLine('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return null;
        }

        $token = substr($authHeader, 7);
        $db    = \Config\Database::connect();
        $user  = $db->table('auth_user')->where('token', $token)->get()->getRow();

        return $user ?? null;
    }

    // POST /api/teacher (protected)
    public function create()
    {
        $user = $this->verifyToken();
        if (!$user) {
            return $this->response->setStatusCode(401)->setJSON(['message' => 'Unauthorized']);
        }

        $json = $this->request->getJSON();

        $university_name = $json->university_name ?? '';
        $gender          = $json->gender ?? '';
        $year_joined     = $json->year_joined ?? '';
        $subject         = $json->subject ?? '';

        if (!$university_name || !$gender || !$year_joined || !$subject) {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'All fields are required']);
        }

        $db = \Config\Database::connect();

        // Check if teacher already exists for this user
        $existing = $db->table('teachers')->where('user_id', $user->id)->get()->getRow();
        if ($existing) {
            return $this->response->setStatusCode(409)->setJSON(['message' => 'Teacher profile already exists for this user']);
        }

        $db->table('teachers')->insert([
            'user_id'         => $user->id,
            'university_name' => $university_name,
            'gender'          => $gender,
            'year_joined'     => $year_joined,
            'subject'         => $subject,
        ]);

        return $this->response->setStatusCode(201)->setJSON(['message' => 'Teacher created successfully']);
    }

    // GET /api/teachers (protected)
    public function index()
    {
        $user = $this->verifyToken();
        if (!$user) {
            return $this->response->setStatusCode(401)->setJSON(['message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();

        // Join teachers with auth_user to get full data
        $teachers = $db->table('teachers t')
            ->select('t.id, t.university_name, t.gender, t.year_joined, t.subject, t.created_at,
                      u.email, u.first_name, u.last_name')
            ->join('auth_user u', 'u.id = t.user_id')
            ->get()
            ->getResultArray();

        return $this->response->setStatusCode(200)->setJSON(['teachers' => $teachers]);
    }
}