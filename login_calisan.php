<?php
session_start(); 

include "db.php";

$error = "";

if ($_POST) {
    $stmt = $pdo->prepare(
        "SELECT * FROM users WHERE username=? AND password=? AND role='calisan'"
    );
    $stmt->execute([$_POST['username'], $_POST['password']]);
    $user = $stmt->fetch();

    if ($user) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = 'calisan';

     
        if (isset($_POST['remember'])) {
            setcookie("user_id", $user['id'], time() + 604800, "/");
            setcookie("role", "calisan", time() + 604800, "/");
        }

        header("Location: calisan.php");
        exit;

    } else {
        $error = "Çalışan bilgileri hatalı";
    }
}
?>

<link rel="stylesheet" href="style.css">



<div class="container">
    <h2>Çalışan Girişi</h2>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <input name="username" placeholder="Kullanıcı adı">
        <input type="password" name="password" placeholder="Şifre">

<div class="remember">
    <input type="checkbox" name="remember" id="remember">
    <label for="remember">Beni hatırla</label>
</div>

        <button>Giriş Yap</button>
    </form>
</div>
