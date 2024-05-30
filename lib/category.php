<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/middleware/admin.php';
require_once __DIR__ . '/database/database.php';
require_once __DIR__ . '/helpers/session_errors.php';

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    echo $twig->render('create-category.html.twig');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['category_name'])) {
        flash_error('category_name', 'Category name is required');
    }

    if (get_errors() != []) {
        echo $twig->render('create-category.html.twig', ['errors' => get_errors()]);
        unset($_SESSION['errors']);
        exit;
    }

    $category = $_POST['category_name'];

    $query = "INSERT INTO categories (name) VALUES (:category)";
    $db->query($query, [
        ['name' => ':category', 'value' => $category, 'type' => SQLITE3_TEXT]
    ]);
    http_response_code(303);
    header("Location: /menu");
    exit;
}
header('Location: /menu');
exit;
