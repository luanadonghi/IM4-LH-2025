<?php
require_once 'system/database.php';
require_once 'system/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header('Location: /profil.php');
        exit;
    } else {
        $error = "Falsches Passwort oder E-Mail.";
    }
}

if ($eingeloggt) {
    header('Location: /profil.php');
    exit;
}

?>

<html>

<head>
    <title>Einloggen</title>
    <link rel="stylesheet" href="/styles/styles.css">
    <link rel="stylesheet" href="/styles/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ranchers&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="header">
        <a href="/">
            <img src="/images/logo.png" width="197" height="58">
        </a>
        <a href="/login.php">
            <img src="/images/account-icon.svg" width="32" height="32">
        </a>
    </div>
    <div class="container login-container">
        <h1 class="big-title">EINLOGGEN</h1>
        <form style="margin-bottom: 50px;" method="POST" action="/login.php">
            <div class="eingabefeld">
                <label for="email">E-Mail</label>
                <input type="email" name="email" required>
            </div>
            <div class="eingabefeld">
                <label for="password">Passwort</label>
                <input type="password" name="password" required>
            </div>
            <button class="button" type="submit">Einloggen</button>
            <div class="fehler"><?php if (isset($error)) echo $error; ?></div>
        </form>
        <div class="noch-kein-konto">Noch kein Konto? Kein Problem! Registriere dich jetzt.</div>
        <a class="button" href="/register.php">Profil erstellen</a>
        <img src="/images/eingloggen.png" height="566" width="566" class="login-illustration">
    </div>
</body>

</html>