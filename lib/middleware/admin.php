<?php

require_once __DIR__ . '/../bootstrap.php';

if ($_SESSION['role'] !== 'ADMIN') {
    header('Location: /');
    exit;
}
