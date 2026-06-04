<?php
$conn = new mysqli("localhost", "TON_USER", "TON_MOT_DE_PASSE", "TON_NOM_BDD");
if ($conn->connect_error) {
    die("Erreur connexion");
}
$nom = $_POST['nom'] ?? '';
$telephone = $_POST['telephone'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';
$type = $_POST['type_reparation'] ?? 'contact';

$stmt = $conn->prepare("INSERT INTO demandes (nom, telephone, email, message, type_reparation, date_demande) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("sssss", $nom, $telephone, $email, $message, $type);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: index.html");
exit();
?>
