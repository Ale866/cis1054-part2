<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/database/database.php';

$database = new Database();
$user_id = $_SESSION['user_id'] ?? 'NULL';
$category_filter = $_GET['category'] ?? null;
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
    LEFT JOIN favorites f ON f.menu_id = m.id AND f.user_id = :user_id";

$params = [
    ['name' => 'user_id', 'value' => $user_id, 'type' => SQLITE3_INTEGER]
];

if ($category_filter) {
    $query .= " WHERE c.id = :category";
    $params[] = ['name' => 'category', 'value' => $category_filter, 'type' => SQLITE3_INTEGER];
}

$menu_items = $database->query($query, $params)->fetchAll();

$categories = $database->query("SELECT * FROM categories")->fetchAll();

echo $twig->render('menu.html.twig', ['menu_items' => $menu_items, 'categories' => $categories, 'category_filter' => $category_filter ?? '']);
