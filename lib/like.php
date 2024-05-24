<?php

require_once './bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once './database/database.php';
    $database = new Database();
    $input = json_decode(file_get_contents('php://input'), true);
    if (!isset($input['menu_id'])) {
        http_response_code(422);
        echo "Missing menu_id field";
        exit;
    }
    $result = $database->query("SELECT * FROM favorites WHERE menu_id = :menu_id AND user_id = :user_id", [
        ['name' => 'menu_id', 'value' => $input['menu_id'], 'type' => SQLITE3_INTEGER],
        ['name' => 'user_id', 'value' => $_SESSION['user_id'], 'type' => SQLITE3_INTEGER]
    ])->first();

    if ($result) {
        $database->query("DELETE FROM favorites WHERE menu_id = :menu_id AND user_id = :user_id", [
            ['name' => 'menu_id', 'value' => $input['menu_id'], 'type' => SQLITE3_INTEGER],
            ['name' => 'user_id', 'value' => $_SESSION['user_id'], 'type' => SQLITE3_INTEGER]
        ]);
        echo json_encode(['liked' => false]);
        exit;
    }

    $database->query("INSERT INTO favorites (menu_id, user_id) VALUES (:menu_id, :user_id)", [
        ['name' => 'menu_id', 'value' => $input['menu_id'], 'type' => SQLITE3_INTEGER],
        ['name' => 'user_id', 'value' => $_SESSION['user_id'], 'type' => SQLITE3_INTEGER]
    ]);
    echo json_encode(['liked' => true]);
    exit;
}
