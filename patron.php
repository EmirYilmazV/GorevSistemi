<?php
include "db.php";


include "auth.php";
if ($_SESSION['role'] !== 'patron') {
    header("Location: index.php");
    exit;
}

$users = $pdo->query("SELECT * FROM users WHERE role='calisan'")->fetchAll();
$tasks = $pdo->query("
    SELECT tasks.*, users.username 
    FROM tasks 
    LEFT JOIN users ON users.id = tasks.assigned_to
")->fetchAll();
?>

<link rel="stylesheet" href="style.css">




<div class="container">
    <h3>Görev Oluştur</h3>

    <form method="post" action="task_add.php">
        <input name="title" placeholder="Görev Başlığı">
        <textarea name="description" placeholder="Görev Açıklaması"></textarea>

        <select name="assigned_to">
            <?php foreach ($users as $u): ?>
                <option value="<?= $u['id'] ?>"><?= $u['username'] ?></option>
            <?php endforeach; ?>
        </select>

        <button>Görev Ata</button>
    </form>

    <a href="patron_reports.php">📄 Raporlar</a>

    <a href="add_employee.php">➕ Çalışan Ekle</a>

    <h3>Mevcut Görevler</h3>

    <?php foreach ($tasks as $t): ?>
        <div class="card">
            <b><?= $t['title'] ?></b><br>
            <?= $t['description'] ?><br>
            Çalışan: <?= $t['username'] ?? '—' ?>
            <div class="status"><?= $t['status'] ?></div>
        </div>
    <?php endforeach; ?>

   
</div>