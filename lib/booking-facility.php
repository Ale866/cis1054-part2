<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/database/database.php';
require_once __DIR__ . '/helpers/mail.php';
require_once __DIR__ . '/helpers/user.php';

$db = new Database();
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $date = isset($_GET['date']) ?  DateTime::createFromFormat('Y-m-d', $_GET['date'])->format('Y-m-d') : date('Y-m-d');
    $tables = $db->query(
        "SELECT 
    DISTINCT t.id, 
    t.n_person,
    CASE WHEN b.date IS NULL THEN 0 ELSE 1 END AS taken
    FROM tables t
    LEFT JOIN bookings b ON b.table_id = t.id AND b.date = :date
    WHERE b.date = :date OR b.date IS NULL
    ORDER BY t.id",
        [
            ['name' => 'date', 'value' => $date, 'type' => SQLITE3_TEXT]
        ]
    )->fetchAll();

    echo $twig->render('booking-facility.html.twig', ['tables' => $tables, 'date' => $date]);
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $input = json_decode(file_get_contents('php://input'), true);
    $input['date'] = isset($input['date']) ? date('Y-m-d', strtotime($input['date'])) : date('Y-m-d');
    if (!isset($input['tables'])) {
        http_response_code(422);
        echo "Missing menu_id field";
        exit;
    }
    $tables = $input['tables'];

    foreach ($tables as $table) {
        // add admin check 
        $db->query('INSERT INTO bookings(table_id, user_id, date) VALUES (:table_id, :user_id, :date)', [
            ['name' => 'table_id', 'value' => $table['id'], 'type' => SQLITE3_INTEGER],
            ['name' => 'date', 'value' => $input['date'], 'type' => SQLITE3_TEXT],
            ['name' => 'user_id', 'value' => $_SESSION['user_id'], 'type' => SQLITE3_INTEGER]
        ]);
    }

    $phpmailer = Mail::getPhpMailer();

    // Content
    $tables = implode(", ", array_map(function ($table) {
        return $table['id'];
    }, $tables));
    // Recipient
    $phpmailer->Body = "You have booked tables $tables for the day {$input['date']} at Pizzeria Mammamia.";
    $phpmailer->Subject = 'Booking Confirmation - Pizzeria Mammamia';

    // Sender information
    $phpmailer->setFrom('pizzeriamammamia1054@gmail.com', 'PIZZERIA MAMMAMIA');
    $user = (new User($db))->getLoggedUser();
    $phpmailer->addAddress($user['email']);
    // Attempt to send the ephpmailer
    if (!$phpmailer->send()) {
        echo 'Email not sent. An error was encountered: ' . $phpmailer->ErrorInfo;
    } else {
        echo 'Message has been sent.';
    }

    $phpmailer->smtpClose();
}
