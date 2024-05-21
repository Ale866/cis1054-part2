<?php
require_once __DIR__ . '/../bootstrap.php';

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
