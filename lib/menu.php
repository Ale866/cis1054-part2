<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/database/database.php';

$database = new Database();
$user_id = $_SESSION['user_id'] ?? 'NULL';
$menu_items = $database->query("SELECT 
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
", [
    ['name' => 'user_id', 'value' => $user_id, 'type' => SQLITE3_INTEGER]
])->fetchAll();

echo $twig->render('menu.html.twig', ['menu_items' => $menu_items]);
