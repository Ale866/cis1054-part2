<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/middleware/guest.php';
require_once __DIR__ . '/database/database.php';
require_once __DIR__ . '/authentication/login.php';

$database = new Database();
$login = new Login($database);

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = $login->login($email, $password);

    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit();
    } else {
        flash_error('email', 'Invalid email or password');
    }
}
echo $twig->render('login.html.twig', ['errors' => $_SESSION['errors'] ?? '', 'email' => $_POST['email'] ?? '']);
unset($_SESSION['errors']);
