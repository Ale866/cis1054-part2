<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/helpers/dish.php';
require_once __DIR__ . '/database/database.php';

if ($_SERVER['REQUEST_METHOD'] != "GET") {
    header('Location: index.php');
}

if (!isset($_GET['dish_id'])) {
    header('Location: menu.php');
}
$db = new Database();

$dish = (new Dish($db))->getDish($_GET['dish_id']);

echo $twig->render('dish_detail.html.twig', ['dish' => $dish]);
