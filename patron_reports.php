<?php
include "db.php";
include "auth.php";
if ($_SESSION['role'] !== 'patron') {
    header("Location: index.php");
    exit;
}

$reports = $pdo->query("
    SELECT reports.*, users.username, tasks.title
    FROM reports
    JOIN users ON users.id = reports.employee_id
    JOIN tasks ON tasks.id = reports.task_id
    ORDER BY reports.created_at DESC
")->fetchAll();
?>

<link rel="stylesheet" href="style.css">


<div class="container">
    <h3>Görev Raporları</h3>

    <?php foreach ($reports as $r): ?>
        <div class="card">
            <b><?= $r['title'] ?></b><br>
            Çalışan: <?= $r['username'] ?><br>
            <small><?= $r['created_at'] ?></small>
            <p><?= $r['report'] ?></p>
        </div>
    <?php endforeach; ?>
</div>