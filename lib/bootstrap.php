<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/env.php';
require_once __DIR__ . '/helpers/session_errors.php';
session_start();


$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);
$twig->addGlobal('logged', isset($_SESSION['user_id']));
