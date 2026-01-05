<?php
include "db.php";
include "auth.php";
if ($_SESSION['role'] !== 'calisan') {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("
    SELECT * FROM tasks
    WHERE assigned_to=?
    ORDER BY id DESC
");
$stmt->execute([$_SESSION['user_id']]);
$tasks = $stmt->fetchAll();
?>

<link rel="stylesheet" href="style.css">

<div class="container">
    <h3>Görevlerim</h3>

    <?php foreach ($tasks as $t): ?>
        <div class="big-card">
            <b><?= htmlspecialchars($t['title']) ?></b><br><br>
            <?= nl2br(htmlspecialchars($t['description'])) ?><br><br>

            <?php if ($t['status'] === 'tamamlandi'): ?>
                <div class="status done">✅ Tamamlandı</div>
            <?php else: ?>
                <form method="post" action="task_complete.php">
                    <input type="hidden" name="task_id" value="<?= $t['id'] ?>">

                    <textarea name="report" placeholder="Kısa rapor (isteğe bağlı)"></textarea>

                    <button>Görevi Tamamla</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
