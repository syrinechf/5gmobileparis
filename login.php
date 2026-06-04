<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  if ($username === "admin" && $password === "1234") {
    $_SESSION['admin'] = true;
    header("Location: admin.php");
    exit();
  } else {
    $error = "Identifiants incorrects";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion Admin – 5G Mobile Paris</title>

  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
</head>

<body style="display:flex;justify-content:center;align-items:center;height:100vh;">

  <form method="POST" class="contact-form" style="width:320px;">

    <h2 style="text-align:center;margin-bottom:20px;">Connexion admin</h2>

    <?php if ($error): ?>
      <p style="color:red;text-align:center;"><?= $error ?></p>
    <?php endif; ?>

    <div class="form-group">
      <label>Identifiant</label>
      <input type="text" name="username" required>
    </div>

    <div class="form-group">
      <label>Mot de passe</label>
      <input type="password" name="password" required>
    </div>

    <button class="btn-submit" type="submit">
      Se connecter
    </button>

  </form>

</body>
</html>