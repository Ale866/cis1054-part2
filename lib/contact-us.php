<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/helpers/mail.php';
require_once __DIR__ . '/helpers/session_errors.php';
require_once __DIR__ . '/helpers/utils.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['email']) || empty($_POST['message']) || empty($_POST['object'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
        if (empty($_POST['email'])) {
            flash_error('email', 'Email is required');
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            flash_error('email', 'Invalid email');
        }
        if (empty($_POST['message'])) {
            flash_error('message', 'Message is required');
        }
        if (empty($_POST['object'])) {
            flash_error('object', 'Object is required');
        }
        echo $twig->render('contact-us.html.twig', ['errors' => get_errors()]);
        unset($_SESSION['errors']);
        exit;
    }
    $object = $_POST['object'];
    $object = clean_input($object);

    $email = $_POST['email'];
    $email = clean_input($email);
    $message = $_POST['message'];
    $message = clean_input($message);

    $mail = (new Mail())->getPhpMailer();
    $mail->Body = $message . "\n\n" . $email . ' is the sender of this message';
    $mail->Subject = $object;
    $mail->addAddress('pizzeriamammamia1054@gmail.com');
    $mail->setFrom($email, 'Pizzeria Mamma Mia Contact Form');

    if (!$mail->send()) {
        flash_error('email', 'An error occurred while sending the email');
        echo $twig->render('contact-us.html.twig', ['errors' => get_errors()]);
        unset($_SESSION['errors']);
        exit;
    } else {
        echo $twig->render('contact-us.html.twig');
        exit;
    }
}
echo $twig->render('contact-us.html.twig');
