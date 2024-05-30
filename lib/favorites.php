<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/database/database.php';
require_once __DIR__ . '/middleware/authenticated.php';
require_once __DIR__ . '/helpers/mail.php';

function fetchDishes($database, $user_id, $category = false)
{
    $query = "SELECT 
    m.id,
    m.name,
    m.price,
    c.name as category,
    m.description,
    m.image_path as image,
    1 as favorite
    FROM menu m 
    INNER JOIN categories c ON m.category_id = c.id
    INNER JOIN favorites f ON f.menu_id = m.id AND f.user_id = :user_id";

    $params = [
        ['name' => 'user_id', 'value' => $user_id, 'type' => SQLITE3_INTEGER],
    ];
    if ($category) {
        $query .= " WHERE c.id = :category";
        $params[] = ['name' => 'category', 'value' => $category, 'type' => SQLITE3_INTEGER];
    }

    $menu_items = $database->query($query, $params)->fetchAll();
    return $menu_items;
}

$database = new Database();
$user_id = $_SESSION['user_id'] ?? 'NULL';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'] ?? null;
    if ($email == null) {
        header('Location: /favorites');
        exit();
    }

    $dishes = fetchDishes($database, $_SESSION['user_id']);

    $phpmailer = Mail::getPhpMailer();
    $phpmailer->Body = "Hello, $email! Here are the dishes that {$_SESSION['email']} has saved as favorites:\n\n";
    $phpmailer->Body .= implode("\n", array_map(function ($dish) {
        return "$dish[name] - $dish[price]€";
    }, $dishes));
    $phpmailer->Subject = 'Favorites from Pizzeria Mammamia';
    $phpmailer->setFrom('pizzeriamammamia1054@gmail.com', 'PIZZERIA MAMMAMIA');
    $phpmailer->addAddress($email);
    // Attempt to send the ephpmailer
    if (!$phpmailer->send()) {
        echo 'Email not sent. An error was encountered: ' . $phpmailer->ErrorInfo;
    } else {
        echo 'Message has been sent.';
    }

    $phpmailer->smtpClose();
    header('Location: /favorites');
    exit();
}

$category_filter = $_GET['category'] ?? null;

$menu_items = fetchDishes($database, $user_id, $category_filter);

$categories = $database->query("SELECT * FROM categories")->fetchAll();

echo $twig->render('favorites.html.twig', ['menu_items' => $menu_items, 'categories' => $categories, 'category_filter' => $category_filter ?? '']);
