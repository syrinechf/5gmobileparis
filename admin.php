<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}
$conn = new mysqli("localhost", "TON_USER", "TON_MOT_DE_PASSE", "TON_NOM_BDD");
if ($conn->connect_error) {
  die("Connexion échouée");
}
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $conn->query("DELETE FROM demandes WHERE id=$id");
}
$total = $conn->query("SELECT COUNT(*) as total FROM demandes")->fetch_assoc()['total'];
$result = $conn->query("SELECT * FROM demandes ORDER BY date_demande DESC");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin – 5G Mobile Paris</title>
  <link rel="stylesheet" href="style.css">
  <style>
    table { width:100%; border-collapse:collapse; margin-top:30px; }
    th, td { padding:12px; text-align:left; }
    th { background:#1db954; color:black; font-weight:700; }
    tr { border-bottom:1px solid rgba(255,255,255,0.1); }
    tr:hover { background:rgba(29,185,84,0.05); }
    .delete-btn { color:red; font-weight:bold; text-decoration:none; }
    .delete-btn:hover { text-decoration:underline; }
  </style>
</head>
<body>
<nav>
  <div class="nav-logo">ADMIN PANEL</div>
  <a href="logout.php" class="nav-cta">Se déconnecter</a>
</nav>
<section style="padding:120px 2.5rem;">
  <div class="container">
    <h1 class="section-title">Dashboard</h1>
    <div class="services-grid" style="margin-bottom:30px;">
      <div class="service-card">
        <div class="service-title">📊 Total demandes</div>
        <div class="service-desc"><?= $total ?> demandes</div>
      </div>
      <div class="service-card">
        <div class="service-title">📩 Messages reçus</div>
        <div class="service-desc">Gestion clients</div>
      </div>
    </div>
    <table>
      <tr>
        <th>Nom</th>
        <th>Téléphone</th>
        <th>Email</th>
        <th>Type</th>
        <th>Modèle</th>
        <th>Message</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
      <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['nom']) ?></td>
        <td><?= htmlspecialchars($row['telephone']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td>
          <?php if($row['type_reparation'] === 'reservation'): ?>
            🔥 Réservation
          <?php elseif($row['type_reparation'] === 'demande_vente'): ?>
            🟡 Demande vente
          <?php else: ?>
            📩 <?= htmlspecialchars($row['type_reparation']) ?>
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($row['modele'] ?? '—') ?></td>
        <td><?= htmlspecialchars($row['message']) ?></td>
        <td><?= $row['date_demande'] ?></td>
        <td>
          <a href="?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Supprimer cette demande ?')">
            Supprimer
          </a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>
</section>
</body>
</html>
