<?php
include "db.php";

$error = "";

if ($_POST) {
    $stmt = $pdo->prepare(
        "SELECT * FROM users WHERE username=? AND password=? AND role='patron'"
    );
    $stmt->execute([$_POST['username'], $_POST['password']]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = 'patron';
        header("Location: patron.php");
        exit;
    } else {
        $error = "Patron bilgileri hatalı";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">
    <h2>Patron Girişi</h2>
    <?php if ($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

    <form method="post">
        <input name="username" placeholder="Kullanıcı adı">
        <input type="password" name="password" placeholder="Şifre">
        <button>Giriş Yap</button>
    </form>
</div>