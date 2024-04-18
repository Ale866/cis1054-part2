<?php
require_once './bootstrap.php';

echo $twig->render('index.html.twig', [
    'title' => 'Hello, World!',
    'content' => 'This is a simple example of a Twig template.',
]);
