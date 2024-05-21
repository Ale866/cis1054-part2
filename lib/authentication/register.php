<?php
require_once __DIR__ . '/../bootstrap.php';

class Register
{
    public Database $db;

    public function __construct(Database $database)
    {
        $this->db = $database;
    }

    private function check_duplicate_email($email): bool
    {
        $query = "SELECT * FROM users WHERE email = :email";

        $result = $this->db->query($query, [
            ['name' => ':email', 'value' => $email, 'type' => SQLITE3_TEXT]
        ])->fetchAll();

        return count($result) > 0;
    }

    private function check_invalid_password($password): bool
    {
        return strlen($password) < 8;
    }

    public function register(string $email, string $password): array
    {
        $errors = [];

        if ($this->check_duplicate_email($email)) {
            $errors[] = 'Email already exists';
        }

        if ($this->check_invalid_password($password)) {
            $errors[] = 'Password must be at least 8 characters';
        }

        if ($errors != []) {
            return $errors;
        }

        $query = "INSERT INTO users (email, password) VALUES (:email, :password)";

        $password = password_hash($password, PASSWORD_DEFAULT);



        $this->db->query($query, [
            ['name' => ':email', 'value' => $email, 'type' => SQLITE3_TEXT],
            ['name' => ':password', 'value' => $password, 'type' => SQLITE3_TEXT]
        ]);

        return [];
    }
}
