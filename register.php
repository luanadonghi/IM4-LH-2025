<?php
require_once 'system/database.php';
require_once 'system/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $password = $_POST['passwort'];

    if (empty($firstname) || empty($email) || empty($password)) {
        $error = "Alle Felder müssen ausgefüllt werden.";
    } elseif (strlen($password) < 8) {
        $error = "Das Passwort muss mindestens 8 Zeichen lang sein.";
    } else {
        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $error = "Diese E-Mail-Adresse ist bereits registriert.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare('INSERT INTO users (firstname, email, password) VALUES (:firstname, :email, :password)');
            $stmt->execute([':firstname' => $firstname, ':email' => $email, ':password' => $hashedPassword]);

            // Redirect to login page
            header('Location: /login.php');
            exit;
        }
    }
}

if ($eingeloggt) {
    header('Location: /profil.php');
    exit;
}

?>


<html>

<head>
    <title>Registrieren</title>
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
        <h1 class="big-title">PROFIL ERSTELLEN</h1>
        <form style="margin-bottom: 50px;" action="/register.php" method="POST">
            <div class="eingabefeld">
                <label for="firstname">Vorname</label>
                <input type="text" name="firstname" required>
            </div>
            <div class="eingabefeld">
                <label for="email">E-Mail Adresse</label>
                <input type="email" name="email" required>
            </div>
            <div class="eingabefeld">
                <label for="passwort">Passwort</label>
                <input type="password" name="passwort" minlength="8" required>
            </div>
            <button class="button" type="submit">Los geht's</button>
            <div class="fehler"><?php if (isset($error)) echo $error; ?></div>
        </form>
        <img src="/images/registrieren.png" height="491" width="491" class="login-illustration">
    </div>
</body>

</html>