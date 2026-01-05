<?php
include "db.php";
include "auth.php";

$stmt = $pdo->prepare("
    INSERT INTO tasks (title, description, assigned_to)
    VALUES (?, ?, ?)
");

$stmt->execute([
    $_POST['title'],
    $_POST['description'],
    $_POST['assigned_to']
]);

header("Location: patron.php");