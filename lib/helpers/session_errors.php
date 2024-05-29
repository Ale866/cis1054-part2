<?php
require_once __DIR__ . '/../bootstrap.php';
function flash_errors(array $errors)
{
    array_map(function ($key, $error) {
        flash_error($key, $error);
    }, array_keys($errors), $errors);
}

function flash_error(string $key, string $error)
{
    if (!isset($_SESSION['errors'])) {
        $_SESSION['errors'] = [];
    }
    $_SESSION['errors'][$key] = $error;
}
