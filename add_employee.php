<?php
include "db.php";
include "auth.php";
if ($_SESSION['role'] !== 'patron') die("Yetkisiz");

if ($_POST) {
    $stmt = $pdo->prepare("
        INSERT INTO users (username, password, role)
        VALUES (?, ?, 'calisan')
    ");
    $stmt->execute([
        $_POST['username'],
        $_POST['password']
    ]);
    $msg = "Çalışan eklendi";
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">
    <h3>Yeni Çalışan Ekle</h3>

    <?php if (!empty($msg)): ?><div class="status"><?= $msg ?></div><?php endif; ?>

    <form method="post">
        <input name="username" placeholder="Kullanıcı adı">
        <input name="password" placeholder="Şifre">
        <button>Ekle</button>
    </form>
</div>