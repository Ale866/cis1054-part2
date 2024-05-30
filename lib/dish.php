<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/middleware/admin.php';
require_once __DIR__ . '/database/database.php';
require_once __DIR__ . '/helpers/session_errors.php';
require_once __DIR__ . '/helpers/dish.php';

$db = new Database();

$dish = new Dish($db);
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $categories = $db->query("SELECT * FROM categories")->fetch_all();
    echo $twig->render('create-dish.html.twig', ['categories' => $categories]);
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'] ?? null;
    $price = $_POST['price'] ?? null;
    $category = $_POST['category_id'] ?? null;
    $description = $_POST['description'] ?? null;
    $image = $_FILES['image'] ?? null;

    $errors = $dish->create($name, $price, $category, $description, $image);
    if (!empty($errors)) {
        flash_errors($errors);
        $categories = $db->query("SELECT * FROM categories")->fetch_all();
        echo $twig->render('create-dish.html.twig', ['errors' => $errors, 'categories' => $categories, 'old' => ['name' => $name, 'price' => $price, 'category_id' => $category, 'description' => $description]]);
        exit;
    }
    http_response_code(303);
    header('Location: /dish-detail.php?dish_id=' . $db->last_inserted_id());
    exit;
} else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    $id = $_GET['dish_id'];
    $dish->delete($id);
    header('Location: /menu.php');
    exit;
}

header('Location: /menu.php');
exit;
