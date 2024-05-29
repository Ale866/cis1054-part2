<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/database/database.php';

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header('Location: /menu');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $category = $_POST['category_name'];
    $query = "INSERT INTO categories (name) VALUES (:category)";
    $db->query($query, [
        ['name' => ':category', 'value' => $category, 'type' => SQLITE3_TEXT]
    ]);
    header('Location: /menu');
    exit;
}
