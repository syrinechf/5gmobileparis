<?php
$conn = new mysqli("localhost", "root", "root", "repair_shop");

if ($conn->connect_error) {
  die("Connexion échouée");
}

$success = false;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nom = trim($_POST['nom'] ?? '');
  $telephone = trim($_POST['telephone'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $type = $_POST['type'] ?? '';
  $modele = trim($_POST['modele'] ?? '');
  $message = trim($_POST['message'] ?? '');

  $stmt = $conn->prepare("INSERT INTO demandes (nom, telephone, email, type_reparation, message) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $nom, $telephone, $email, $type, $message);

  if ($stmt->execute()) {
    $success = true;
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact – 5G Mobile Paris</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet" />
  <style>
    :root {
      --green: #1db954;
      --green-dark: #148a3d;
      --black: #ffffff;
      --dark: #f4faf6;
      --card: #ffffff;
      --text: #0f1f12;
      --muted: #4a7a58;
      --border: rgba(29,185,84,0.2);
    }
    * { margin:0; padding:0; box-sizing:border-box; }
    html { scroll-behavior:smooth; }
    body { font-family:'DM Sans',sans-serif; background:#ffffff; color:var(--text); overflow-x:hidden; }

    /* NAV */
    nav {
      position:fixed; top:0; left:0; right:0; z-index:200;
      display:flex; align-items:center; justify-content:space-between;
      padding:0.9rem 2.5rem;
      background:rgba(255,255,255,0.95); backdrop-filter:blur(16px);
      border-bottom:1px solid rgba(29,185,84,0.25);
    }
    .nav-logo { font-family:'Syne',sans-serif; font-weight:800; font-size:1.25rem; color:var(--green); text-decoration:none; }
    .nav-logo span { color:var(--text); }
    .nav-links { display:flex; gap:2rem; list-style:none; }
    .nav-links a { color:var(--muted); text-decoration:none; font-size:0.88rem; font-weight:500; transition:color .2s; }
    .nav-links a:hover, .nav-links a.active { color:var(--green); }
    .nav-cta { background:var(--green); color:#fff; padding:0.5rem 1.25rem; border-radius:100px; font-weight:700; font-size:0.85rem; text-decoration:none; transition:all .2s; }
    .nav-cta:hover { background:#25d162; transform:translateY(-1px); }

    /* BANNER */
    .top-banner { margin-top:60px; background:var(--green); text-align:center; padding:0.55rem 1rem; font-family:'Syne',sans-serif; font-weight:700; font-size:0.82rem; color:#fff; letter-spacing:0.5px; }

    /* HERO CONTACT */
    .contact-hero {
      padding:6rem 5vw 4rem;
      background:#ffffff;
      position:relative;
      overflow:hidden;
    }
    .contact-hero::before {
      content:'';
      position:absolute;
      inset:0;
      background:radial-gradient(ellipse 60% 70% at 90% 40%, rgba(29,185,84,0.08) 0%, transparent 70%);
      z-index:0;
    }
    .contact-hero .max { position:relative; z-index:1; }
    .contact-hero .section-label { font-size:0.72rem; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:var(--green); margin-bottom:0.6rem; }
    .contact-hero h1 { font-family:'Syne',sans-serif; font-size:clamp(2.2rem,5vw,4rem); font-weight:800; letter-spacing:-2px; line-height:1.06; margin-bottom:1rem; }
    .contact-hero h1 em { font-style:normal; color:var(--green); }
    .contact-hero p { color:var(--muted); font-size:1rem; line-height:1.7; max-width:500px; }

    /* FLOATING PILLS */
    .hero-pills { display:flex; gap:0.75rem; flex-wrap:wrap; margin-top:1.8rem; }
    .pill {
      display:inline-flex; align-items:center; gap:0.4rem;
      background:#f0faf4; border:1px solid rgba(29,185,84,0.25);
      border-radius:100px; padding:0.38rem 1rem;
      font-size:0.78rem; color:var(--green); font-weight:600;
      animation:pill-float 3s ease-in-out infinite;
    }
    .pill:nth-child(2) { animation-delay:0.4s; }
    .pill:nth-child(3) { animation-delay:0.8s; }
    @keyframes pill-float {
      0%,100%{ transform:translateY(0); }
      50%{ transform:translateY(-4px); }
    }

    /* CARDS INFO */
    .info-section { padding:3rem 5vw; background:#ffffff; }
    .info-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1.2rem; }
    .info-card {
      background:#ffffff;
      border:1px solid var(--border);
      border-radius:20px;
      padding:1.8rem;
      text-align:center;
      position:relative; overflow:hidden;
      transition:all .35s cubic-bezier(.22,.68,0,1.2);
      cursor:default;
    }
    .info-card::before {
      content:'';
      position:absolute; top:0; left:0; right:0; height:3px;
      background:var(--green);
      transform:scaleX(0); transform-origin:left;
      transition:transform .35s ease;
    }
    .info-card:hover { transform:translateY(-8px); box-shadow:0 24px 48px rgba(29,185,84,0.1); border-color:rgba(29,185,84,0.4); }
    .info-card:hover::before { transform:scaleX(1); }
    .info-icon {
      width:56px; height:56px;
      background:rgba(29,185,84,0.1);
      border:1px solid rgba(29,185,84,0.2);
      border-radius:16px;
      display:flex; align-items:center; justify-content:center;
      font-size:1.4rem;
      margin:0 auto 1rem;
      transition:all .3s;
    }
    .info-card:hover .info-icon { background:var(--green); transform:scale(1.08) rotate(-5deg); }
    .info-title { font-family:'Syne',sans-serif; font-weight:700; font-size:0.95rem; margin-bottom:0.4rem; }
    .info-val { color:var(--muted); font-size:0.9rem; line-height:1.5; }
    .info-val a { color:var(--muted); text-decoration:none; transition:color .2s; }
    .info-val a:hover { color:var(--green); }

    /* HORAIRES */
    .horaires-section { padding:3rem 5vw; background:var(--dark); }
    .horaires-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1rem; margin-top:1.5rem; }
    .horaire-card {
      background:#fff;
      border:1px solid var(--border);
      border-radius:18px;
      padding:1.6rem;
      text-align:center;
      transition:all .3s;
      position:relative; overflow:hidden;
    }
    .horaire-card.closed { opacity:0.6; }
    .horaire-card:not(.closed):hover { transform:translateY(-5px); border-color:var(--green); box-shadow:0 16px 32px rgba(29,185,84,0.1); }
    .horaire-day { font-family:'Syne',sans-serif; font-weight:700; font-size:0.95rem; color:var(--green); margin-bottom:0.4rem; }
    .horaire-time { color:var(--muted); font-size:0.88rem; }
    .horaire-badge {
      display:inline-block; margin-top:0.7rem;
      background:rgba(29,185,84,0.1); color:var(--green);
      font-size:0.7rem; font-weight:700; letter-spacing:0.5px;
      padding:0.2rem 0.7rem; border-radius:100px;
    }
    .horaire-badge.closed-badge { background:rgba(0,0,0,0.05); color:#999; }

    /* FORMULAIRE SECTION */
    .form-section { padding:4rem 5vw; background:#ffffff; }
    .form-layout { display:grid; grid-template-columns:1fr 1.5fr; gap:3rem; align-items:start; }

    /* LEFT */
    .form-left h2 { font-family:'Syne',sans-serif; font-size:clamp(1.6rem,3vw,2.2rem); font-weight:800; letter-spacing:-1px; margin-bottom:0.8rem; }
    .form-left h2 em { font-style:normal; color:var(--green); }
    .form-left p { color:var(--muted); font-size:0.9rem; line-height:1.7; margin-bottom:1.8rem; }

    .trust-items { display:flex; flex-direction:column; gap:0.8rem; }
    .trust-item {
      display:flex; align-items:center; gap:0.9rem;
      background:#f8fdf9; border:1px solid rgba(29,185,84,0.15);
      border-radius:12px; padding:0.8rem 1rem;
      transition:all .3s;
    }
    .trust-item:hover { border-color:rgba(29,185,84,0.4); background:#f0faf4; transform:translateX(4px); }
    .trust-dot { width:8px; height:8px; background:var(--green); border-radius:50%; flex-shrink:0; }
    .trust-text { font-size:0.85rem; color:var(--muted); }
    .trust-text strong { color:var(--text); }

    .map-mini {
      margin-top:1.5rem;
      border-radius:16px; overflow:hidden;
      border:1px solid var(--border);
      transition:box-shadow .3s;
    }
    .map-mini:hover { box-shadow:0 12px 32px rgba(29,185,84,0.12); }

    /* FORM CARD */
    .form-card {
      background:#ffffff;
      border:1px solid var(--border);
      border-radius:24px;
      padding:2.2rem;
      box-shadow:0 8px 32px rgba(0,0,0,0.04);
      position:relative;
    }
    .form-card::before {
      content:'';
      position:absolute; top:0; left:2rem; right:2rem; height:2px;
      background:linear-gradient(90deg, transparent, var(--green), transparent);
      border-radius:0 0 2px 2px;
    }
    .form-title { font-family:'Syne',sans-serif; font-weight:800; font-size:1.2rem; margin-bottom:0.4rem; }
    .form-sub { color:var(--muted); font-size:0.82rem; margin-bottom:1.8rem; }

    .fg { margin-bottom:1.1rem; }
    .fg label {
      display:block; font-size:0.75rem; color:var(--muted);
      margin-bottom:0.35rem; font-weight:600;
      text-transform:uppercase; letter-spacing:0.5px;
    }
    .fg input, .fg textarea, .fg select {
      width:100%;
      background:#f7faf8;
      border:1.5px solid rgba(29,185,84,0.15);
      border-radius:12px;
      padding:0.78rem 1rem;
      color:var(--text);
      font-family:'DM Sans',sans-serif;
      font-size:0.92rem;
      outline:none;
      transition:all .25s;
      appearance:none;
    }
    .fg input:focus, .fg textarea:focus, .fg select:focus {
      border-color:var(--green);
      background:#f0faf4;
      box-shadow:0 0 0 3px rgba(29,185,84,0.08);
    }
    .fg input::placeholder, .fg textarea::placeholder { color:#aac7b3; }
    .fg textarea { resize:vertical; min-height:110px; }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }

    .select-wrap { position:relative; }
    .select-wrap::after {
      content:'▾';
      position:absolute; right:1rem; top:50%; transform:translateY(-50%);
      color:var(--green); pointer-events:none; font-size:0.9rem;
    }
    .select-wrap select { padding-right:2.5rem; cursor:pointer; }

    .btn-send {
      width:100%; background:var(--green); color:#fff;
      border:none; padding:1rem;
      border-radius:100px;
      font-family:'Syne',sans-serif; font-weight:700; font-size:1rem;
      cursor:pointer; transition:all .25s;
      display:flex; align-items:center; justify-content:center; gap:0.5rem;
      position:relative; overflow:hidden;
    }
    .btn-send::after {
      content:'';
      position:absolute; inset:0;
      background:rgba(255,255,255,0.15);
      transform:translateX(-100%);
      transition:transform .4s;
    }
    .btn-send:hover { background:#25d162; transform:translateY(-2px); box-shadow:0 12px 28px rgba(29,185,84,0.3); }
    .btn-send:hover::after { transform:translateX(100%); }
    .btn-send:active { transform:translateY(0); }

    /* SUCCESS */
    .success-msg {
      background:#f0faf4; border:1.5px solid var(--green);
      border-radius:16px; padding:1.2rem 1.5rem;
      margin-bottom:1.5rem;
      display:flex; align-items:center; gap:0.8rem;
      animation:pop-in .4s cubic-bezier(.22,.68,0,1.2) both;
    }
    @keyframes pop-in {
      from { transform:scale(0.9); opacity:0; }
      to { transform:scale(1); opacity:1; }
    }
    .success-msg .check { font-size:1.4rem; }
    .success-msg p { color:var(--green); font-weight:700; font-size:0.92rem; }

    /* MAP SECTION */
    .map-section { padding:4rem 5vw; background:var(--dark); }

    /* FOOTER */
    footer { background:#f0f8f2; border-top:1px solid var(--border); padding:2rem 5vw; }
    .footer-inner { max-width:1140px; margin:0 auto; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem; }
    .footer-logo { font-family:'Syne',sans-serif; font-weight:800; color:var(--green); font-size:1.05rem; }
    .footer-logo span { color:var(--muted); }
    .footer-copy { font-size:0.78rem; color:var(--muted); }
    .footer-links { display:flex; gap:1.5rem; list-style:none; }
    .footer-links a { font-size:0.8rem; color:var(--muted); text-decoration:none; transition:color .2s; }
    .footer-links a:hover { color:var(--green); }

    /* SECTION HELPERS */
    .max { max-width:1140px; margin:0 auto; }
    .section-label { font-size:0.72rem; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:var(--green); margin-bottom:0.6rem; }
    .section-title { font-family:'Syne',sans-serif; font-size:clamp(1.8rem,3.5vw,2.6rem); font-weight:800; letter-spacing:-1px; line-height:1.1; margin-bottom:0.8rem; }
    .section-sub { color:var(--muted); font-size:0.95rem; line-height:1.7; margin-bottom:2rem; }

    /* ANIMATIONS */
    .fi { opacity:0; transform:translateY(24px); transition:opacity .65s ease, transform .65s ease; }
    .fi.on { opacity:1; transform:translateY(0); }
    .fi-left { opacity:0; transform:translateX(-28px); transition:opacity .65s ease, transform .65s ease; }
    .fi-left.on { opacity:1; transform:translateX(0); }
    .fi-right { opacity:0; transform:translateX(28px); transition:opacity .65s ease, transform .65s ease; }
    .fi-right.on { opacity:1; transform:translateX(0); }

    /* PULSE DOT */
    .pulse-dot { width:8px; height:8px; background:var(--green); border-radius:50%; animation:pulse 2s infinite; flex-shrink:0; }
    @keyframes pulse { 0%,100%{ box-shadow:0 0 0 0 rgba(29,185,84,0.4); } 50%{ box-shadow:0 0 0 6px rgba(29,185,84,0); } }

    /* COUNTER */
    .counters { display:grid; grid-template-columns:repeat(3,1fr); gap:1rem; margin-top:1.5rem; }
    .counter-box { background:#f0faf4; border:1px solid rgba(29,185,84,0.2); border-radius:14px; padding:1.2rem; text-align:center; }
    .counter-num { font-family:'Syne',sans-serif; font-weight:800; font-size:1.8rem; color:var(--green); }
    .counter-lbl { font-size:0.75rem; color:var(--muted); margin-top:0.2rem; }

    @media(max-width:960px) {
      nav { padding:0.9rem 1.2rem; }
      .nav-links { display:none; }
      .info-grid, .horaires-grid { grid-template-columns:1fr; }
      .form-layout { grid-template-columns:1fr; }
      .form-row { grid-template-columns:1fr; }
      .counters { grid-template-columns:1fr 1fr; }
    }
  </style>
</head>
<body>

<!-- NAV -->
<nav>
  <a href="index.php" class="nav-logo">5G <span>Mobile Paris</span></a>
  <ul class="nav-links">
    <li><a href="index.php">Accueil</a></li>
    <li><a href="apropos.php">À propos</a></li>
    <li><a href="reparation.php">Réparation</a></li>
    <li><a href="vente.php">Vente</a></li>
    <li><a href="contact.php" class="active">Contact</a></li>
  </ul>
  <a href="tel:0756894694" class="nav-cta">📞 07 56 89 46 94</a>
</nav>
<div class="top-banner">⚡ Réparation express · Devis gratuit · Garantie 3 à 12 mois · Paris 13ème · Sans rendez-vous</div>

<!-- HERO -->
<section class="contact-hero">
  <div class="max">
    <div class="section-label fi">Contact</div>
    <h1 class="fi">Parlons de votre <em>panne</em></h1>
    <p class="fi">Remplissez le formulaire, appelez-nous ou passez directement en boutique — nous répondons vite.</p>
    <div class="hero-pills fi">
      <span class="pill"><span class="pulse-dot"></span>Disponible maintenant</span>
      <span class="pill">⚡ Réponse en moins de 2h</span>
      <span class="pill">✅ Devis 100% gratuit</span>
    </div>
  </div>
</section>

<!-- INFOS -->
<section class="info-section">
  <div class="max">
    <div class="info-grid">

      <div class="info-card fi">
        <div class="info-icon">📞</div>
        <div class="info-title">Téléphone</div>
        <div class="info-val"><a href="tel:0756894694">07 56 89 46 94</a></div>
      </div>

      <div class="info-card fi" style="transition-delay:.1s">
        <div class="info-icon">✉️</div>
        <div class="info-title">Email</div>
        <div class="info-val"><a href="mailto:5gmobileparis@gmail.com">5gmobileparis@gmail.com</a></div>
      </div>

      <div class="info-card fi" style="transition-delay:.2s">
        <div class="info-icon">📍</div>
        <div class="info-title">Adresse</div>
        <div class="info-val">50 Rue Jenner, 75013 Paris</div>
      </div>

    </div>
  </div>
</section>

<!-- HORAIRES -->
<section class="horaires-section">
  <div class="max">
    <div class="section-label fi">Horaires</div>
    <h2 class="section-title fi">Quand nous trouver ?</h2>
    <div class="horaires-grid">

      <div class="horaire-card fi">
        <div class="horaire-day">Lundi – Vendredi</div>
        <div class="horaire-time">10h30 – 19h30</div>
        <span class="horaire-badge">Ouvert</span>
      </div>

      <div class="horaire-card fi" style="transition-delay:.1s">
        <div class="horaire-day">Samedi</div>
        <div class="horaire-time">10h30 – 19h30</div>
        <span class="horaire-badge">Ouvert</span>
      </div>

      <div class="horaire-card fi closed" style="transition-delay:.2s">
        <div class="horaire-day" style="color:#999;">Dimanche</div>
        <div class="horaire-time">—</div>
        <span class="horaire-badge closed-badge">Fermé</span>
      </div>

    </div>

    <div class="counters fi" style="transition-delay:.3s">
      <div class="counter-box"><div class="counter-num" data-target="150">724</div><div class="counter-lbl">Avis Google</div></div>
      <div class="counter-box"><div class="counter-num" data-target="4.9" data-decimal="1">4.9</div><div class="counter-lbl">Note moyenne</div></div>
      <div class="counter-box"><div class="counter-num" data-target="2000">1200</div><div class="counter-lbl">Téléphones réparés</div></div>
    </div>
  </div>
</section>

<!-- FORMULAIRE -->
<section class="form-section">
  <div class="max">
    <div class="form-layout">

      <!-- LEFT -->
      <div>
        <div class="section-label fi-left">Demande de devis</div>
        <h2 class="fi-left">Décrivez votre <em>panne</em></h2>
        <p class="fi-left">On vous répond rapidement avec un devis transparent. Pas de surprise, pas de mauvaise surprise.</p>

        <div class="trust-items fi-left" style="transition-delay:.15s">
          <div class="trust-item"><div class="trust-dot"></div><div class="trust-text"><strong>Diagnostic gratuit</strong> — aucun frais si vous refusez le devis</div></div>
          <div class="trust-item"><div class="trust-dot"></div><div class="trust-text"><strong>Garantie 3 à 12 mois</strong> — sur toutes les réparations</div></div>
          <div class="trust-item"><div class="trust-dot"></div><div class="trust-text"><strong>Pièces certifiées</strong> — qualité OLED ou d'origine</div></div>
          <div class="trust-item"><div class="trust-dot"></div><div class="trust-text"><strong>Réparation en 30 min</strong> — pour les pannes courantes</div></div>
        </div>

        <div class="map-mini fi-left" style="transition-delay:.25s">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.5!2d2.3614!3d48.8286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671e0b1f6dd83%3A0x0!2s50+Rue+Jenner%2C+75013+Paris!5e0!3m2!1sfr!2sfr!4v1700000000000"
            width="100%" height="200" style="border:0;display:block;" allowfullscreen="" loading="lazy">
          </iframe>
        </div>
      </div>

      <!-- FORM -->
      <div class="form-card fi-right">

        <?php if ($success): ?>
        <div class="success-msg">
          <span class="check">✅</span>
          <p>Demande envoyée avec succès ! On vous contacte très vite.</p>
        </div>
        <?php endif; ?>

        <div class="form-title">Votre demande de devis</div>
        <div class="form-sub">Réponse garantie sous 2 heures · Devis 100% gratuit</div>

        <form method="POST">
          <div class="form-row">
            <div class="fg">
              <label>Votre nom</label>
              <input type="text" name="nom" placeholder="Jean Dupont" required />
            </div>
            <div class="fg">
              <label>Téléphone</label>
              <input type="tel" name="telephone" placeholder="06 XX XX XX XX" required />
            </div>
          </div>

          <div class="fg">
            <label>Email</label>
            <input type="email" name="email" placeholder="votre@email.com" required />
          </div>

          <div class="fg">
            <label>Type de réparation</label>
            <div class="select-wrap">
              <select name="type">
                <option value="">Sélectionnez un service</option>
                <option>Remplacement d'écran</option>
                <option>Remplacement vitre arrière</option>
                <option>Remplacement de batterie</option>
                <option>Réparation connecteur de charge</option>
                <option>Dégâts liquides</option>
                <option>Réparation caméra</option>
                <option>Autre panne</option>
              </select>
            </div>
          </div>

          <div class="fg">
            <label>Marque & modèle</label>
            <input type="text" name="modele" placeholder="Ex: iPhone 14 Pro, Samsung S23…" />
          </div>

          <div class="fg">
            <label>Description de la panne</label>
            <textarea name="message" placeholder="Décrivez le problème rencontré…"></textarea>
          </div>

          <button class="btn-send" type="submit">
            Envoyer ma demande →
          </button>
        </form>
      </div>

    </div>
  </div>
</section>

<!-- MAP -->
<section class="map-section">
  <div class="max">
    <div class="section-label fi">Localisation</div>
    <h2 class="section-title fi">Nous trouver à Paris 13</h2>
    <p class="section-sub fi">50 Rue Jenner, 75013 Paris — accessible en métro ligne 5 (Place d'Italie) et ligne 7 (Tolbiac)</p>
    <div style="border-radius:20px;overflow:hidden;border:1px solid rgba(29,185,84,0.2);box-shadow:0 8px 32px rgba(29,185,84,0.08);" class="fi">
      <iframe
        src="https://www.google.com/maps?q=50+rue+jenner+75013+paris&output=embed"
        width="100%"
        height="380"
        style="border:0;display:block;"
        loading="lazy">
      </iframe>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-inner">
    <div class="footer-logo">5G <span>Mobile Paris</span></div>
    <div class="footer-copy">© 2025 5G Mobile Paris · 50 Rue Jenner, 75013 Paris</div>
    <ul class="footer-links">
      <li><a href="index.php">Accueil</a></li>
      <li><a href="apropos.php">À propos</a></li>
      <li><a href="reparation.php">Réparation</a></li>
      <li><a href="vente.php">Vente</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
  </div>
</footer>

<script>
/* INTERSECTION OBSERVER */
const obs = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.classList.add('on');
      obs.unobserve(e.target);
    }
  });
}, { threshold: 0.08 });

document.querySelectorAll('.fi,.fi-left,.fi-right').forEach(el => obs.observe(el));

/* COUNTERS */
function animateCounter(el) {
  const target = parseFloat(el.dataset.target);
  const decimal = parseInt(el.dataset.decimal || 0);
  const duration = 1600;
  const start = performance.now();

  function step(now) {
    const progress = Math.min((now - start) / duration, 1);
    const eased = 1 - Math.pow(1 - progress, 3);
    const val = eased * target;
    el.textContent = decimal > 0 ? val.toFixed(decimal) : Math.floor(val).toLocaleString('fr-FR');
    if (progress < 1) requestAnimationFrame(step);
    else el.textContent = decimal > 0 ? target.toFixed(decimal) : target.toLocaleString('fr-FR');
  }
  requestAnimationFrame(step);
}

const counterObs = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.querySelectorAll && e.target.querySelectorAll('[data-target]').forEach(animateCounter);
      counterObs.unobserve(e.target);
    }
  });
}, { threshold: 0.3 });

document.querySelectorAll('.counters').forEach(el => counterObs.observe(el));

/* FORM INPUT LABELS FLOAT EFFECT */
document.querySelectorAll('.fg input, .fg textarea').forEach(input => {
  input.addEventListener('focus', () => {
    input.closest('.fg').querySelector('label').style.color = '#1db954';
  });
  input.addEventListener('blur', () => {
    input.closest('.fg').querySelector('label').style.color = '';
  });
});
</script>

</body>
</html>