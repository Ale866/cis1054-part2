<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/database/database.php';
require_once __DIR__ . '/helpers/dish.php';

$db = new Database();

$dish = new Dish($db);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category_id'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    $dish->create($name, $price, $category, $description, $image);
    header('Location: /menu');
    exit;
} else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    $id = $_GET['dish_id'];
    $dish->delete($id);
    echo $twig->render('dish/create.html', ['categories' => $categories]);
    exit;
}
