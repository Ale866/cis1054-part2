<?php

require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../database/database.php';

class User
{
    private Database $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getLoggedUser()
    {
        $user_id = $_SESSION['user_id'];

        $query = "SELECT id,email FROM users WHERE id=:id";
        return $this->db->query($query, [
            ['name' => 'id', 'value' => $user_id, 'type' => SQLITE3_INTEGER]
        ])->first();
    }
}
