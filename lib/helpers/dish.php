<?php

require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../database/database.php';

class Dish
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getDish(string $dish_id): array
    {
        $user_id = $_SESSION['user_id'] ?? null;
        $query = "SELECT 
        m.id,
        m.name,
        m.price,
        c.name as category,
        m.description,
        m.image_path as image,
        IIF(f.id IS NOT NULL, 1,0) as favorite
        FROM menu m 
        INNER JOIN categories c ON m.category_id = c.id
        LEFT JOIN favorites f ON f.menu_id = m.id AND f.user_id = :user_id
        WHERE m.id=:id
        ";
        return $this->db->query($query, [
            ['name' => 'id', 'value' => $dish_id, 'type' => SQLITE3_INTEGER],
            ['name' => 'user_id', 'value' => $user_id, 'type' => SQLITE3_INTEGER]
        ])->first();
    }
}
