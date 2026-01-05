<?php
$host = "localhost";
$port = "5432";
$db   = "employee_system";
$user = "postgres";
$pass = "emir005"; // kendi şifren

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Bağlantı hatası: " . $e->getMessage());
}

session_start();