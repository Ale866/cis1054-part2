<?php
require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/login.php';
require_once __DIR__ . '/../helpers/utils.php';

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
        ])->fetch_all();

        return count($result) > 0;
    }

    private function validate_email($email): bool
    {
        $email = clean_input($_POST["email"]);
        //FILTER_VALIDATE_EMAIL is one of many validation filters: https://www.php.net/manual/en/filter.filters.validate.php
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function check_invalid_password($password): bool
    {
        return strlen($password) < 8;
    }

    public function register(string $email, string $password): array
    {
        $errors = [];

        if ($this->check_duplicate_email($email)) {
            $errors['email'] = 'Email already exists';
        }

        if ($this->validate_email($email)) {
            if (!isset($errors['email'])) {
                $errors['email'] = 'Invalid email';
            } else {
                $errors['email'] = 'And it\'s invalid';
            }
        }

        if ($this->check_invalid_password($password)) {
            $errors['password'] = 'Password must be at least 8 characters';
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

        $login = new Login($this->db);
        $login->login($email, $password);

        return [];
    }
}
