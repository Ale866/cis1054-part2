<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/database/database.php';

$db = new Database();
if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $tables = $db->query("SELECT * FROM tables ORDER BY id")->fetchAll();

    echo $twig->render('booking-facility.html.twig', ['tables' => $tables]);
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!isset($input['tables'])) {
        http_response_code(422);
        echo "Missing menu_id field";
        exit;
    }
    $tables = $input['tables'];

    foreach ($tables as $table) {
        // add admin check 
        $db->query('UPDATE tables SET is_taken=:is_taken WHERE id=:id', [
            ['name' => 'is_taken', 'value' => $table['isTaken'], 'type' => SQLITE3_INTEGER],
            ['name' => 'id', 'value' => $table['id'], 'type' => SQLITE3_INTEGER],
        ]);
    }
}
