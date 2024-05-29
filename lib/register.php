<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/middleware/guest.php';
require_once __DIR__ . '/database/database.php';
require_once __DIR__ . '/authentication/register.php';

$database = new Database();
$register = new Register($database);

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = $register->register($email, $password);

    if ($errors == []) {
        $_SESSION['user'] = $email;
        header('Location: index.php');
        exit();
    } else {
        flash_errors($errors);
    }
}

echo $twig->render('register.html.twig', [
    'errors' => $_SESSION['errors'] ?? '',
    'email' => $_POST['email'] ?? '',
]);
unset($_SESSION['errors']);
