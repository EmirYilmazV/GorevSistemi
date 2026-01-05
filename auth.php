<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id']) && isset($_COOKIE['role'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['role'] = $_COOKIE['role'];
}


if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: index.php");
    exit;
}
