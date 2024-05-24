<?php
require_once __DIR__ . '/../bootstrap.php';

class Login
{
    public Database $db;

    public function __construct(Database $database)
    {
        $this->db = $database;
    }

    public function login($email, $password): bool
    {
        $query = "SELECT * FROM users WHERE email = :email";

        $user = $this->db->query($query, [
            ['name' => ':email', 'value' => $email, 'type' => SQLITE3_TEXT]
        ])->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                return true;
            }
        }

        return false;
    }

    public function logout(): void
    {
        session_destroy();
    }
}
