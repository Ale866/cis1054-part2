<?php
require_once __DIR__ . '/../bootstrap.php';
function flash_errors(array $errors)
{
    $_SESSION['errors'] = $errors;
}

function flash_error(string $error)
{
    if (!isset($_SESSION['errors'])) {
        $_SESSION['errors'] = [];
    }
    var_dump($_SESSION['errors']);
    $_SESSION['errors'][] = $error;
}
