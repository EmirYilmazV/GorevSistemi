<?php
include "db.php";
include "auth.php";
if ($_SESSION['role'] !== 'calisan') {
    header("Location: index.php");
    exit;
}

$pdo->prepare("
    UPDATE tasks SET status='tamamlandi' WHERE id=?
")->execute([$_POST['task_id']]);

$pdo->prepare("
    INSERT INTO reports (task_id, employee_id, report)
    VALUES (?, ?, ?)
")->execute([
    $_POST['task_id'],
    $_SESSION['user_id'],
    $_POST['report']
]);

header("Location: calisan.php");