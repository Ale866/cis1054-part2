<?php
require_once './bootstrap.php';
require_once './database/database.php';

$database = new Database();
$menu_items = $database->query("SELECT 
    m.name,
    m.price,
    c.name as category,
    m.description,
    m.image_path as image
    FROM menu m 
    INNER JOIN categories c ON m.category_id = c.id
")->fetchAll();

echo $twig->render('menu.html.twig', ['menu_items' => $menu_items]);
