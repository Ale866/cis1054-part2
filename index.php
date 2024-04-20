<?php

require_once './lib/bootstrap.php';

echo $twig->render('index.html.twig', [
    'title' => 'Hello, World!',
    'content' => 'This is a simple example of a Twig template.',
]);
