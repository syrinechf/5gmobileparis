<?php
$conn = new mysqli("localhost", "u530169248_usr_3dET03ua", "Syrinejasim94@.", "u530169248_db_3dET03ua");
if ($conn->connect_error) { die("Connexion échouée"); }

$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nom = trim($_POST['nom'] ?? '');
  $telephone = trim($_POST['telephone'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $type = trim($_POST['type'] ?? '');
  $modele = trim($_POST['modele'] ?? '');
  $message = trim($_POST['message'] ?? '');
  $stmt = $conn->prepare("INSERT INTO demandes (nom, telephone, email, type_reparation, modele, message) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $nom, $telephone, $email, $type, $modele, $message);
  if ($stmt->execute()) { $success = true; }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>5G Mobile Paris – Réparation Téléphone Paris 13</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet" />
  <style>
    :root {
      --green: #1db954; --green-dark: #148a3d; --black: #ffffff; --dark: #f4faf6;
      --card: #ffffff; --text: #0f1f12; --muted: #4a7a58; --border: rgba(29,185,84,0.2);
    }
    * { margin:0; padding:0; box-sizing:border-box; }
    html { scroll-behavior:smooth; }
    body { font-family:'DM Sans',sans-serif; background:var(--black); color:var(--text); overflow-x:hidden; }

    nav { position:fixed; top:0; left:0; right:0; z-index:200; display:flex; align-items:center; justify-content:space-between; padding:0.9rem 2.5rem; background:rgba(255,255,255,0.97); backdrop-filter:blur(16px); border-bottom:1px solid rgba(29,185,84,0.25); }
    .nav-logo { font-family:'Syne',sans-serif; font-weight:800; font-size:1.25rem; color:var(--green); text-decoration:none; }
    .nav-logo span { color:var(--text); }
    .nav-links { display:flex; gap:2rem; list-style:none; }
    .nav-links a { color:var(--muted); text-decoration:none; font-size:0.88rem; font-weight:500; transition:color .2s; }
    .nav-links a:hover, .nav-links a.active { color:var(--green); }
    .nav-cta { background:var(--green); color:#fff; padding:0.5rem 1.25rem; border-radius:100px; font-weight:700; font-size:0.85rem; text-decoration:none; transition:all .2s; }
    .nav-cta:hover { background:#25d162; transform:translateY(-1px); }

    .burger { display:none; flex-direction:column; gap:5px; cursor:pointer; padding:4px; background:none; border:none; }
    .burger span { display:block; width:24px; height:2px; background:var(--text); border-radius:2px; transition:all .3s; }
    .burger.open span:nth-child(1) { transform:rotate(45deg) translate(5px,5px); }
    .burger.open span:nth-child(2) { opacity:0; }
    .burger.open span:nth-child(3) { transform:rotate(-45deg) translate(5px,-5px); }

    .mobile-menu { display:none; position:fixed; top:60px; left:0; right:0; background:#fff; z-index:199; border-bottom:1px solid var(--border); padding:1rem 1.5rem 1.5rem; flex-direction:column; gap:0; box-shadow:0 10px 30px rgba(0,0,0,0.08); }
    .mobile-menu.open { display:flex; }
    .mobile-menu a { color:var(--text); text-decoration:none; font-size:1.05rem; font-weight:600; padding:0.85rem 0; border-bottom:1px solid var(--border); font-family:'Syne',sans-serif; }
    .mobile-menu a:last-child { border-bottom:none; }
    .mobile-menu a:hover, .mobile-menu a.active { color:var(--green); }
    .mobile-menu .mobile-cta { margin-top:1rem; background:var(--green); color:#fff; text-align:center; padding:0.85rem; border-radius:100px; font-weight:700; border-bottom:none; }

    .top-banner { margin-top:60px; background:var(--green); text-align:center; padding:0.55rem 1rem; font-family:'Syne',sans-serif; font-weight:700; font-size:0.82rem; color:#fff; letter-spacing:0.5px; }

    .hero { display:grid; grid-template-columns:1fr 1fr; gap:3rem; align-items:center; padding:5rem 5vw 4rem; min-height:92vh; position:relative; overflow:hidden; }
    .hero-bg { position:absolute; inset:0; z-index:0; background:radial-gradient(ellipse 70% 60% at 80% 50%, rgba(29,185,84,0.1) 0%, transparent 65%); }
    .hero-left { position:relative; z-index:1; }
    .hero-badge { display:inline-flex; align-items:center; gap:0.5rem; background:rgba(29,185,84,0.1); border:1px solid rgba(29,185,84,0.3); border-radius:100px; padding:0.38rem 1rem; font-size:0.78rem; color:var(--green); font-weight:600; letter-spacing:0.5px; margin-bottom:1.4rem; }
    .hero-badge::before { content:''; width:7px; height:7px; background:var(--green); border-radius:50%; animation:blink 2s infinite; }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }
    .hero h1 { font-family:'Syne',sans-serif; font-size:clamp(2rem,5vw,4.2rem); font-weight:800; line-height:1.06; letter-spacing:-2px; margin-bottom:1.1rem; }
    .hero h1 em { font-style:normal; color:var(--green); }
    .hero-sub { color:#4a7a58; font-size:1rem; line-height:1.7; max-width:480px; margin-bottom:2rem; }
    .hero-actions { display:flex; gap:1rem; flex-wrap:wrap; margin-bottom:2.5rem; }
    .btn-green { background:var(--green); color:#fff; padding:0.8rem 1.8rem; border-radius:100px; font-weight:700; font-size:0.92rem; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem; transition:all .2s; }
    .btn-green:hover { background:#25d162; transform:translateY(-2px); box-shadow:0 10px 30px rgba(29,185,84,0.25); }
    .btn-outline { border:1.5px solid rgba(29,185,84,0.4); color:var(--green); padding:0.8rem 1.8rem; border-radius:100px; font-weight:600; font-size:0.92rem; text-decoration:none; transition:all .2s; }
    .btn-outline:hover { background:rgba(29,185,84,0.08); transform:translateY(-2px); }
    .google-strip { display:flex; align-items:center; gap:0.8rem; background:var(--card); border:1px solid var(--border); border-radius:12px; padding:0.8rem 1.2rem; width:fit-content; }
    .g-stars { color:#fbbc04; font-size:1.1rem; letter-spacing:1px; }
    .g-text { font-size:0.82rem; color:var(--muted); }
    .g-text strong { color:var(--text); }
    .hero-right { position:relative; z-index:1; height:520px; }
    .photo-main { position:absolute; top:0; left:0; right:0; bottom:60px; border-radius:24px; overflow:hidden; border:2px solid var(--border); box-shadow:0 30px 60px rgba(0,0,0,0.08); }
    .photo-main img { width:100%; height:100%; object-fit:cover; }
    .photo-float { position:absolute; bottom:0; right:0; width:55%; border-radius:18px; overflow:hidden; border:2px solid var(--green); box-shadow:0 20px 40px rgba(0,0,0,0.1),0 0 30px rgba(29,185,84,0.15); }
    .photo-float img { width:100%; height:160px; object-fit:cover; }
    .badge-float { position:absolute; top:1rem; right:1rem; background:var(--green); color:#fff; font-family:'Syne',sans-serif; font-weight:800; font-size:0.8rem; padding:0.5rem 1rem; border-radius:100px; }

    .marquee { background:var(--green); padding:0.65rem 0; overflow:hidden; white-space:nowrap; }
    .marquee-inner { display:inline-block; animation:slide 22s linear infinite; }
    .marquee-inner span { font-family:'Syne',sans-serif; font-weight:700; font-size:0.8rem; color:#fff; margin:0 2.5rem; letter-spacing:1px; }
    @keyframes slide { from{transform:translateX(0)} to{transform:translateX(-50%)} }

    .section { padding:5rem 5vw; }
    .section-label { font-size:0.72rem; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:var(--green); margin-bottom:0.6rem; }
    .section-title { font-family:'Syne',sans-serif; font-size:clamp(1.8rem,3.5vw,2.6rem); font-weight:800; letter-spacing:-1px; line-height:1.1; margin-bottom:0.8rem; }
    .section-sub { color:var(--muted); font-size:0.95rem; line-height:1.7; max-width:520px; margin-bottom:2.5rem; }
    .max { max-width:1140px; margin:0 auto; }

    .services-bg { background:var(--dark); }
    .services-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:1.2rem; }
    .svc { background:var(--card); border:1px solid var(--border); border-radius:18px; box-shadow:0 2px 12px rgba(0,0,0,0.06); padding:1.8rem; transition:all .3s; position:relative; overflow:hidden; }
    .svc::after { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:var(--green); transform:scaleX(0); transform-origin:left; transition:transform .3s; }
    .svc:hover { border-color:rgba(29,185,84,0.35); transform:translateY(-5px); box-shadow:0 20px 40px rgba(0,0,0,0.08); }
    .svc:hover::after { transform:scaleX(1); }
    .svc-icon { font-size:2rem; margin-bottom:0.9rem; }
    .svc-title { font-family:'Syne',sans-serif; font-weight:700; font-size:1.05rem; margin-bottom:0.4rem; }
    .svc-desc { color:var(--muted); font-size:0.85rem; line-height:1.6; }
    .svc-price { display:inline-block; margin-top:1rem; background:rgba(29,185,84,0.1); color:var(--green); font-weight:700; font-size:0.82rem; padding:0.28rem 0.8rem; border-radius:100px; }

    .photos-bg { background:var(--black); }
    .photos-grid { display:grid; grid-template-columns:1.3fr 1fr 1fr; grid-template-rows:240px 240px; gap:1rem; }
    .photo-tile { border-radius:16px; overflow:hidden; position:relative; }
    .photo-tile img { width:100%; height:100%; object-fit:cover; transition:transform .4s; }
    .photo-tile:hover img { transform:scale(1.05); }
    .photo-tile.tall { grid-row:span 2; }
    .photo-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 50%); display:flex; align-items:flex-end; padding:1rem; opacity:0; transition:opacity .3s; }
    .photo-tile:hover .photo-overlay { opacity:1; }
    .photo-overlay span { font-size:0.8rem; font-weight:600; color:var(--green); }

    .avis-bg { background:var(--dark); }
    .avis-header { display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:1rem; margin-bottom:2.5rem; }
    .big-score { font-family:'Syne',sans-serif; font-size:4rem; font-weight:800; color:var(--green); line-height:1; }
    .stars-big { color:#fbbc04; font-size:1.5rem; letter-spacing:2px; }
    .score-count { font-size:0.82rem; color:var(--muted); margin-top:0.2rem; }
    .google-badge { display:flex; align-items:center; gap:0.5rem; background:var(--card); border:1px solid var(--border); border-radius:10px; padding:0.5rem 1rem; font-size:0.8rem; }
    .avis-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:1rem; }
    .avis-card { background:var(--card); border:1px solid var(--border); border-radius:16px; box-shadow:0 2px 12px rgba(0,0,0,0.05); padding:1.4rem; transition:border-color .2s; }
    .avis-card:hover { border-color:rgba(29,185,84,0.3); }
    .avis-top { display:flex; align-items:center; gap:0.9rem; margin-bottom:0.9rem; }
    .avis-avatar { width:42px; height:42px; border-radius:50%; background:var(--green); display:flex; align-items:center; justify-content:center; font-family:'Syne',sans-serif; font-weight:800; font-size:1rem; color:#fff; flex-shrink:0; }
    .avis-name { font-weight:600; font-size:0.9rem; }
    .avis-date { font-size:0.75rem; color:var(--muted); }
    .avis-stars { color:#fbbc04; font-size:0.85rem; letter-spacing:1px; }
    .avis-text { font-size:0.85rem; color:var(--muted); line-height:1.65; font-style:italic; margin-top:0.6rem; }
    .google-icon { margin-left:auto; font-size:1.1rem; opacity:0.5; }

    .how-bg { background:var(--black); }
    .steps-row { display:grid; grid-template-columns:repeat(3,1fr); gap:1.5rem; }
    .step { background:var(--card); border:1px solid var(--border); border-radius:18px; padding:2rem 1.5rem; position:relative; overflow:hidden; }
    .step-num { font-family:'Syne',sans-serif; font-size:4rem; font-weight:800; color:rgba(29,185,84,0.08); position:absolute; top:-0.5rem; right:1rem; line-height:1; }
    .step-circle { width:52px; height:52px; background:var(--green); border-radius:50%; display:flex; align-items:center; justify-content:center; font-family:'Syne',sans-serif; font-weight:800; font-size:1.2rem; color:#fff; margin-bottom:1.2rem; box-shadow:0 0 20px rgba(29,185,84,0.3); }
    .step-title { font-family:'Syne',sans-serif; font-weight:700; font-size:1.05rem; margin-bottom:0.5rem; }
    .step-desc { color:var(--muted); font-size:0.85rem; line-height:1.6; }

    .tarifs-bg { background:var(--dark); }
    .tarifs-table { width:100%; border-collapse:collapse; border-radius:16px; overflow:hidden; border:1px solid var(--border); }
    .tarifs-table th { background:rgba(29,185,84,0.12); padding:1rem 1.4rem; text-align:left; font-family:'Syne',sans-serif; font-weight:700; font-size:0.82rem; letter-spacing:0.5px; color:var(--green); border-bottom:1px solid rgba(29,185,84,0.25); }
    .tarifs-table td { padding:0.85rem 1.4rem; font-size:0.88rem; border-bottom:1px solid rgba(0,0,0,0.04); }
    .tarifs-table tr:last-child td { border-bottom:none; }
    .tarifs-table tr:hover td { background:rgba(29,185,84,0.03); }
    .price { color:var(--green); font-weight:700; font-family:'Syne',sans-serif; }
    .tarif-note { margin-top:1.2rem; padding:1rem 1.4rem; background:rgba(29,185,84,0.07); border:1px solid rgba(29,185,84,0.2); border-radius:12px; font-size:0.84rem; color:var(--muted); }
    .tarifs-mobile { display:none; flex-direction:column; gap:1rem; }
    .tarif-card { background:var(--card); border:1px solid var(--border); border-radius:14px; padding:1.2rem; }
    .tarif-card-title { font-family:'Syne',sans-serif; font-weight:800; font-size:1rem; margin-bottom:0.8rem; color:var(--text); }
    .tarif-row { display:flex; justify-content:space-between; align-items:center; padding:0.4rem 0; border-bottom:1px solid var(--border); font-size:0.85rem; }
    .tarif-row:last-child { border-bottom:none; }
    .tarif-row span:first-child { color:var(--muted); }

    .contact-bg { background:var(--black); }
    .contact-grid { display:grid; grid-template-columns:1fr 1.4fr; gap:3rem; align-items:start; }
    .contact-card { background:var(--card); border:1px solid var(--border); border-radius:18px; padding:2rem; }
    .c-item { display:flex; gap:1rem; align-items:flex-start; margin-bottom:1.4rem; }
    .c-icon { width:42px; height:42px; background:rgba(29,185,84,0.1); border:1px solid rgba(29,185,84,0.2); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1rem; flex-shrink:0; }
    .c-label { font-size:0.72rem; color:var(--muted); margin-bottom:0.15rem; letter-spacing:0.5px; text-transform:uppercase; }
    .c-val { font-weight:600; font-size:0.95rem; color:var(--text); text-decoration:none; }
    .c-val:hover { color:var(--green); }
    .h-title { font-family:'Syne',sans-serif; font-weight:700; font-size:0.85rem; color:var(--green); margin-bottom:0.8rem; margin-top:1.5rem; }
    .h-row { display:flex; justify-content:space-between; font-size:0.82rem; padding:0.35rem 0; border-bottom:1px solid rgba(0,0,0,0.05); color:var(--muted); }
    .h-row:last-child { border-bottom:none; }
    .h-row span:last-child { color:var(--text); font-weight:500; }
    .form-card { background:var(--card); border:1px solid var(--border); border-radius:18px; padding:2rem; }
    .form-title { font-family:'Syne',sans-serif; font-weight:700; font-size:1.15rem; margin-bottom:1.5rem; }
    .fg { margin-bottom:1.1rem; }
    .fg label { display:block; font-size:0.78rem; color:var(--muted); margin-bottom:0.35rem; font-weight:500; text-transform:uppercase; letter-spacing:0.5px; }
    .fg input, .fg textarea, .fg select { width:100%; background:var(--dark); border:1px solid rgba(29,185,84,0.15); border-radius:10px; padding:0.72rem 1rem; color:var(--text); font-family:'DM Sans',sans-serif; font-size:0.9rem; outline:none; transition:border-color .2s; }
    .fg input:focus, .fg textarea:focus, .fg select:focus { border-color:var(--green); }
    .fg textarea { resize:vertical; min-height:100px; }
    .form-row2 { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
    .btn-send { width:100%; background:var(--green); color:#fff; border:none; padding:0.88rem; border-radius:100px; font-family:'Syne',sans-serif; font-weight:700; font-size:0.95rem; cursor:pointer; transition:all .2s; }
    .btn-send:hover { background:#25d162; transform:translateY(-1px); }
    .success-banner { background:#f0faf4; border:1.5px solid var(--green); border-radius:14px; padding:1rem 1.4rem; margin-bottom:1.5rem; color:var(--green); font-weight:700; font-size:0.92rem; display:flex; align-items:center; gap:0.6rem; }

    footer { background:#f0f8f2; border-top:1px solid var(--border); padding:2rem 5vw; }
    .footer-inner { max-width:1140px; margin:0 auto; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem; }
    .footer-logo { font-family:'Syne',sans-serif; font-weight:800; color:var(--green); font-size:1.05rem; }
    .footer-logo span { color:var(--muted); }
    .footer-copy { font-size:0.78rem; color:var(--muted); }
    .footer-links { display:flex; gap:1.5rem; list-style:none; }
    .footer-links a { font-size:0.8rem; color:var(--muted); text-decoration:none; }
    .footer-links a:hover { color:var(--green); }

    .fi { opacity:0; transform:translateY(22px); transition:opacity .6s ease, transform .6s ease; }
    .fi.on { opacity:1; transform:translateY(0); }

    @media(max-width:960px) {
      nav { padding:0.9rem 1.2rem; }
      .nav-links { display:none; }
      .nav-cta { display:none; }
      .burger { display:flex; }
      .hero { grid-template-columns:1fr; min-height:auto; padding:4rem 1.2rem 3rem; }
      .hero-right { display:none; }
      .contact-grid { grid-template-columns:1fr; }
      .steps-row { grid-template-columns:1fr; }
      .photos-grid { grid-template-columns:1fr 1fr; grid-template-rows:auto; }
      .photo-tile.tall { grid-row:span 1; }
      .section { padding:3.5rem 1.2rem; }
      .avis-header { flex-direction:column; align-items:flex-start; }
      .tarifs-table { display:none; }
      .tarifs-mobile { display:flex; }
    }
    @media(max-width:600px) {
      .form-row2 { grid-template-columns:1fr; }
      .photos-grid { grid-template-columns:1fr; }
      .hero-actions { flex-direction:column; }
      .hero-actions a { text-align:center; justify-content:center; }
      .top-banner { font-size:0.72rem; }
    }
  </style>
</head>
<body>

<nav>
  <a href="index.php" class="nav-logo">5G <span>Mobile Paris</span></a>
  <ul class="nav-links">
    <li><a href="index.php" class="active">Accueil</a></li>
    <li><a href="apropos.php">À propos</a></li>
    <li><a href="reparation.php">Réparation</a></li>
    <li><a href="vente.php">Vente</a></li>
    <li><a href="contact.php">Contact</a></li>
  </ul>
  <a href="tel:0756894694" class="nav-cta">📞 07 56 89 46 94</a>
  <button class="burger" id="burger" aria-label="Menu"><span></span><span></span><span></span></button>
</nav>

<div class="mobile-menu" id="mobileMenu">
  <a href="index.php" class="active">🏠 Accueil</a>
  <a href="apropos.php">👋 À propos</a>
  <a href="reparation.php">🔧 Réparation</a>
  <a href="vente.php">📱 Vente</a>
  <a href="contact.php">✉️ Contact</a>
  <a href="tel:0756894694" class="mobile-cta">📞 07 56 89 46 94</a>
</div>

<div class="top-banner">⚡ Réparation express · Devis gratuit · Garantie 3 à 12 mois · Paris 13ème · Sans rendez-vous</div>

<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-left">
    <div class="hero-badge fi">Ouvert lundi – samedi</div>
    <h1 class="fi">Réparez<br/>votre téléphone<br/><em>rapidement</em><br/>et en toute confiance à Paris 13</h1>
    <p class="hero-sub fi">Écran cassé, batterie HS, dégâts liquides… 5G Mobile Paris répare tous vos appareils avec soin. Devis gratuit, intervention rapide, garantie incluse.</p>
    <div class="hero-actions fi">
      <a href="#contact" class="btn-green">🔧 Demander un devis</a>
      <a href="tel:0756894694" class="btn-outline">📞 07 56 89 46 94</a>
    </div>
    <div class="google-strip fi">
      <span style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.3rem;color:#4285f4">G</span>
      <div><div class="g-stars">★★★★★</div><div class="g-text"><strong>4.9/5</strong> sur Google · +700 avis clients</div></div>
    </div>
  </div>
  <div class="hero-right fi">
    <div class="photo-main"><img src="images/extbout.jpeg" alt="Boutique réparation téléphone Paris 13" /></div>
    <div class="photo-float"><img src="images/IMG_6627.JPG" alt="Pièces smartphone" /></div>
    <div class="badge-float">Réparation express ⚡</div>
  </div>
</section>

<div class="marquee"><div class="marquee-inner">
  <span>✦ RÉPARATION EXPRESS</span><span>✦ GARANTIE 3 MOIS</span><span>✦ DEVIS GRATUIT</span>
  <span>✦ TOUTES MARQUES</span><span>✦ PARIS 13ÈME</span><span>✦ SANS RENDEZ-VOUS</span>
  <span>✦ RÉPARATION EXPRESS</span><span>✦ GARANTIE 6 MOIS</span><span>✦ DEVIS GRATUIT</span>
  <span>✦ TOUTES MARQUES</span><span>✦ PARIS 13ÈME</span><span>✦ GARANTIE 12 MOIS</span>
  <span>✦ RÉPARATION EXPRESS</span><span>✦ RÉPARATION EXPRESS</span><span>✦ DEVIS GRATUIT</span>
  <span>✦ TOUTES MARQUES</span><span>✦ PARIS 13ÈME</span><span>✦ SANS RENDEZ-VOUS</span>
</div></div>

<section id="services" class="section services-bg">
  <div class="max">
    <div class="section-label fi">Nos services</div>
    <h2 class="section-title fi">Ce qu'on répare pour vous</h2>
    <p class="section-sub fi">Toutes marques, toutes pannes. iPhone, Samsung, Xiaomi, Huawei et bien plus.</p>
    <div class="services-grid">
      <div class="svc fi"><div class="svc-icon">📱</div><div class="svc-title">Remplacement d'écran</div><div class="svc-desc">Dalle cassée, tactile mort, OLED endommagé — on remplace votre écran avec des pièces qualité, toutes marques.</div><span class="svc-price">Dès 59 €</span></div>
      <div class="svc fi"><div class="svc-icon">🔋</div><div class="svc-title">Remplacement de batterie</div><div class="svc-desc">Autonomie en chute libre, batterie qui gonfle ou chauffe ? On change votre batterie avec une pièce certifiée.</div><span class="svc-price">Dès 49 €</span></div>
      <div class="svc fi"><div class="svc-icon">🔌</div><div class="svc-title">Connecteur de charge</div><div class="svc-desc">Port USB-C, Lightning ou Micro-USB endommagé ? Diagnostic gratuit et remplacement express.</div><span class="svc-price">Dès 35 €</span></div>
      <div class="svc fi"><div class="svc-icon">📲</div><div class="svc-title">Remplacement de vitre arrière</div><div class="svc-desc">Vitre arrière cassée ? On remplace votre vitre avec précision pour redonner à votre téléphone son aspect neuf.</div><span class="svc-price">Dès 49 €</span></div>
      <div class="svc fi"><div class="svc-icon">📷</div><div class="svc-title">Réparation caméra</div><div class="svc-desc">Photos floues, objectif fissuré ou caméra noire — on répare ou remplace votre module caméra avant ou arrière.</div><span class="svc-price">Dès 25 €</span></div>
      <div class="svc fi"><div class="svc-icon">🛠️</div><div class="svc-title">Autres pannes</div><div class="svc-desc">Micro HS, haut-parleur, WiFi, boutons bloqués… Contactez-nous pour un diagnostic, on trouve la solution.</div><span class="svc-price">Sur devis</span></div>
    </div>
  </div>
</section>

<section id="photos" class="section photos-bg">
  <div class="max">
    <div class="section-label fi">Notre atelier</div>
    <h2 class="section-title fi">Des réparations soignées,<br/>des clients satisfaits</h2>
    <p class="section-sub fi">Chaque appareil est traité avec soin, testé et rendu en parfait état de marche.</p>
    <div class="photos-grid fi">
      <div class="photo-tile tall"><img src="images/ecran1.jpeg" alt="Technicien réparation téléphone" /><div class="photo-overlay"><span>Réparation écran</span></div></div>
      <div class="photo-tile"><img src="images/interbout2.jpeg" alt="Boutique" /><div class="photo-overlay"><span>Pièces de qualité</span></div></div>
      <div class="photo-tile"><img src="images/batterie.jpeg" alt="Batterie iPhone" /><div class="photo-overlay"><span>Remplacement batterie</span></div></div>
      <div class="photo-tile"><img src="images/aprestel.jpeg" alt="Réparation iPhone" /><div class="photo-overlay"><span>iPhone réparé</span></div></div>
      <div class="photo-tile"><img src="images/interbout1.jpeg" alt="Accessoires" /><div class="photo-overlay"><span>Accessoires téléphone</span></div></div>
    </div>
  </div>
</section>

<section id="avis" class="section avis-bg">
  <div class="max">
    <div class="avis-header fi">
      <div><div class="section-label">Avis clients</div><h2 class="section-title">Ce que disent nos clients</h2></div>
      <div style="display:flex;align-items:center;gap:2rem;flex-wrap:wrap;">
        <div style="display:flex;align-items:center;gap:1.5rem;"><div class="big-score">4.9</div><div><div class="stars-big">★★★★★</div><div class="score-count">Basé sur +700 avis Google</div></div></div>
        <div class="google-badge"><span style="font-weight:800;color:#4285f4;font-size:1rem">G</span><span style="color:var(--muted);font-size:0.82rem">oogle Reviews</span></div>
      </div>
    </div>
    <div class="avis-grid">
      <div class="avis-card fi"><div class="avis-top"><div class="avis-avatar">S</div><div><div class="avis-name">Sarah M.</div><div class="avis-date">Il y a 2 semaines</div></div><span class="google-icon">G</span></div><div class="avis-stars">★★★★★</div><p class="avis-text">"Écran de mon iPhone 14 remplacé en 30 minutes, prix honnête et travail soigné. Je recommande vivement !"</p></div>
      <div class="avis-card fi"><div class="avis-top"><div class="avis-avatar" style="background:#148a3d">K</div><div><div class="avis-name">Karim B.</div><div class="avis-date">Il y a 1 mois</div></div><span class="google-icon">G</span></div><div class="avis-stars">★★★★★</div><p class="avis-text">"Batterie changée sur mon Samsung Galaxy S22, très rapide et professionnel. Le téléphone tient la charge comme neuf. Merci !"</p></div>
      <div class="avis-card fi"><div class="avis-top"><div class="avis-avatar" style="background:#148a3d">A</div><div><div class="avis-name">Amina D.</div><div class="avis-date">Il y a 3 semaines</div></div><span class="google-icon">G</span></div><div class="avis-stars">★★★★★</div><p class="avis-text">"Mon téléphone était tombé dans l'eau, je pensais le perdre. Diagnostic gratuit, réparation le jour même. Vraiment top !"</p></div>
      <div class="avis-card fi"><div class="avis-top"><div class="avis-avatar" style="background:#25d162;color:#000">L</div><div><div class="avis-name">Lucas P.</div><div class="avis-date">Il y a 2 mois</div></div><span class="google-icon">G</span></div><div class="avis-stars">★★★★★</div><p class="avis-text">"Connecteur de charge réparé sur mon Xiaomi en un rien de temps. Prix très correct et accueil sympa. J'y retournerai sans hésiter."</p></div>
      <div class="avis-card fi"><div class="avis-top"><div class="avis-avatar" style="background:#7ea889;color:#0a0a0a">M</div><div><div class="avis-name">Marie-Claire T.</div><div class="avis-date">Il y a 5 jours</div></div><span class="google-icon">G</span></div><div class="avis-stars">★★★★★</div><p class="avis-text">"Caméra arrière de mon iPhone 13 Pro remplacée avec soin. Le résultat est parfait, les photos sont de nouveau nettes. Super service !"</p></div>
      <div class="avis-card fi"><div class="avis-top"><div class="avis-avatar" style="background:#1db954">R</div><div><div class="avis-name">Rachid O.</div><div class="avis-date">Il y a 1 semaine</div></div><span class="google-icon">G</span></div><div class="avis-stars">★★★★★</div><p class="avis-text">"Réparation rapide, devis transparent, garantie 6 mois. Exactement ce qu'on cherche. Très professionnel, je recommande."</p></div>
    </div>
    <div style="text-align:center;margin-top:2rem;" class="fi">
      <a href="https://share.google/Z9TBUNMKqxSEVc75Z" target="_blank" class="btn-outline" style="display:inline-flex;align-items:center;gap:0.5rem;">Voir tous les avis Google ↗</a>
    </div>
  </div>
</section>

<section id="comment" class="section how-bg">
  <div class="max">
    <div class="section-label fi">Processus</div>
    <h2 class="section-title fi">Comment ça marche ?</h2>
    <p class="section-sub fi">3 étapes simples pour retrouver un smartphone comme neuf.</p>
    <div class="steps-row">
      <div class="step fi"><div class="step-num">01</div><div class="step-circle">1</div><div class="step-title">Passez en boutique</div><div class="step-desc">Venez directement sans rendez-vous 📍. Expliquez votre panne sur place et obtenez un premier avis gratuit en quelques minutes.</div></div>
      <div class="step fi"><div class="step-num">02</div><div class="step-circle">2</div><div class="step-title">Diagnostic & devis</div><div class="step-desc">On examine votre appareil gratuitement et on vous propose un devis clair et précis. Aucune intervention sans votre accord.</div></div>
      <div class="step fi"><div class="step-num">03</div><div class="step-circle">3</div><div class="step-title">Réparation & garantie</div><div class="step-desc">Votre appareil est réparé avec des pièces de qualité, testé et remis avec une garantie de 3 à 12 mois incluse.</div></div>
    </div>
  </div>
</section>

<section id="tarifs" class="section tarifs-bg">
  <div class="max">
    <div class="section-label fi">Grille tarifaire</div>
    <h2 class="section-title fi">Les prix de nos réparations les plus demandées</h2>
    <p class="section-sub fi">Tous nos prix incluent la pièce, la main d'œuvre et la garantie jusqu'à 12 mois.</p>
    <div class="fi">
      <table class="tarifs-table">
        <thead><tr><th>Modèle</th><th>Écran</th><th>Batterie</th><th>Connecteur</th><th>Lentille</th></tr></thead>
        <tbody>
          <tr><td>iPhone 15</td><td><span class="price">Dès 119 €</span></td><td><span class="price">79 €</span></td><td><span class="price">99 €</span></td><td><span class="price">59 €</span></td></tr>
          <tr><td>iPhone 13</td><td><span class="price">Dès 89 €</span></td><td><span class="price">69 €</span></td><td><span class="price">45 €</span></td><td><span class="price">59 €</span></td></tr>
          <tr><td>iPhone 11</td><td><span class="price">Dès 59 €</span></td><td><span class="price">49 €</span></td><td><span class="price">39 €</span></td><td><span class="price">49 €</span></td></tr>
          <tr><td>Samsung Galaxy S</td><td><span class="price">Dès 79 €</span></td><td><span class="price">Sur devis</span></td><td><span class="price">Sur devis</span></td><td><span class="price">Sur devis</span></td></tr>
          <tr><td>Samsung A</td><td><span class="price">Dès 69 €</span></td><td><span class="price">Sur devis</span></td><td><span class="price">Sur devis</span></td><td><span class="price">Sur devis</span></td></tr>
        </tbody>
      </table>
      <div class="tarifs-mobile">
        <div class="tarif-card"><div class="tarif-card-title">📱 iPhone 15</div><div class="tarif-row"><span>Écran</span><span class="price">Dès 119 €</span></div><div class="tarif-row"><span>Batterie</span><span class="price">79 €</span></div><div class="tarif-row"><span>Connecteur</span><span class="price">99 €</span></div><div class="tarif-row"><span>Lentille</span><span class="price">59 €</span></div></div>
        <div class="tarif-card"><div class="tarif-card-title">📱 iPhone 13</div><div class="tarif-row"><span>Écran</span><span class="price">Dès 89 €</span></div><div class="tarif-row"><span>Batterie</span><span class="price">69 €</span></div><div class="tarif-row"><span>Connecteur</span><span class="price">45 €</span></div><div class="tarif-row"><span>Lentille</span><span class="price">59 €</span></div></div>
        <div class="tarif-card"><div class="tarif-card-title">📱 iPhone 11</div><div class="tarif-row"><span>Écran</span><span class="price">59 €</span></div><div class="tarif-row"><span>Batterie</span><span class="price">49 €</span></div><div class="tarif-row"><span>Connecteur</span><span class="price">39 €</span></div><div class="tarif-row"><span>Lentille</span><span class="price">49 €</span></div></div>
        <div class="tarif-card"><div class="tarif-card-title">🌀 Samsung Galaxy S</div><div class="tarif-row"><span>Écran</span><span class="price">Dès 79 €</span></div><div class="tarif-row"><span>Batterie</span><span class="price">Sur devis</span></div><div class="tarif-row"><span>Connecteur</span><span class="price">Sur devis</span></div><div class="tarif-row"><span>Lentille</span><span class="price">Sur devis</span></div></div>
        <div class="tarif-card"><div class="tarif-card-title">🌀 Samsung A</div><div class="tarif-row"><span>Écran</span><span class="price">Dès 69 €</span></div><div class="tarif-row"><span>Batterie</span><span class="price">Sur devis</span></div><div class="tarif-row"><span>Connecteur</span><span class="price">Sur devis</span></div><div class="tarif-row"><span>Lentille</span><span class="price">Sur devis</span></div></div>
      </div>
      <div class="tarif-note">💡 Votre modèle n'est pas dans la liste ? Appelez-nous au <strong>07 56 89 46 94</strong> pour un devis immédiat et gratuit.</div>
      <div style="margin-top:1.2rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
        <p style="font-size:0.88rem;color:var(--muted);margin:0;">Retrouvez tous les tarifs pour chaque modèle d'iPhone, Samsung, Xiaomi et plus encore.</p>
        <a href="reparation.php" class="btn-green" style="white-space:nowrap;">Voir tous les tarifs →</a>
      </div>
    </div>
  </div>
</section>

<section id="contact" class="section contact-bg">
  <div class="max">
    <div class="section-label fi">Nous contacter</div>
    <h2 class="section-title fi">Venez nous voir<br/>ou écrivez-nous</h2>
    <div class="contact-grid">
      <div class="fi">
        <div class="contact-card">
          <div class="c-item"><div class="c-icon">📍</div><div><div class="c-label">Adresse</div><div class="c-val">50 Rue Jenner, 75013 Paris</div></div></div>
          <div class="c-item"><div class="c-icon">📞</div><div><div class="c-label">Téléphone</div><a href="tel:0756894694" class="c-val">07 56 89 46 94</a></div></div>
          <div class="c-item"><div class="c-icon">✉️</div><div><div class="c-label">Email</div><a href="mailto:5gmobileparis@gmail.com" class="c-val">5gmobileparis@gmail.com</a></div></div>
          <div class="h-title">🕒 Horaires d'ouverture</div>
          <div class="h-row"><span>Lundi – Vendredi</span><span>10h30 – 19h30</span></div>
          <div class="h-row"><span>Samedi</span><span>10h30 – 19h30</span></div>
          <div class="h-row"><span>Dimanche</span><span>Fermé</span></div>
        </div>
        <div style="margin-top:1rem;border-radius:14px;overflow:hidden;border:1px solid var(--border);">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.5!2d2.3614!3d48.8286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671e0b1f6dd83%3A0x0!2s50+Rue+Jenner%2C+75013+Paris!5e0!3m2!1sfr!2sfr!4v1700000000000" width="100%" height="200" style="border:0;display:block;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
      <div class="form-card fi">
        <div class="form-title">Décrivez votre panne</div>

        <?php if ($success): ?>
        <div class="success-banner">✅ Demande envoyée ! On vous répond très vite.</div>
        <?php endif; ?>

        <form method="POST" action="index.php#contact">
          <div class="form-row2">
            <div class="fg"><label>Votre nom</label><input type="text" name="nom" placeholder="Jean Dupont" required /></div>
            <div class="fg"><label>Téléphone</label><input type="tel" name="telephone" placeholder="06 XX XX XX XX" required /></div>
          </div>
          <div class="fg"><label>Email</label><input type="email" name="email" placeholder="votre@email.com" /></div>
          <div class="fg">
            <label>Type de réparation</label>
            <select name="type">
              <option value="">Sélectionnez un service</option>
              <option value="Remplacement d'écran">Remplacement d'écran</option>
              <option value="Remplacement vitre arrière">Remplacement vitre arrière</option>
              <option value="Remplacement de batterie">Remplacement de batterie</option>
              <option value="Réparation connecteur de charge">Réparation connecteur de charge</option>
              <option value="Dégâts liquides">Dégâts liquides</option>
              <option value="Réparation caméra">Réparation caméra</option>
              <option value="Autre panne">Autre panne</option>
            </select>
          </div>
          <div class="fg"><label>Marque &amp; modèle</label><input type="text" name="modele" placeholder="Ex: iPhone 14 Pro, Samsung S23..." /></div>
          <div class="fg"><label>Description de la panne</label><textarea name="message" placeholder="Décrivez le problème rencontré..."></textarea></div>
          <button class="btn-send" type="submit">Envoyer ma demande →</button>
        </form>
      </div>
    </div>
  </div>
</section>

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
  const obs = new IntersectionObserver((entries) => {
    entries.forEach((e) => { if (e.isIntersecting) { e.target.classList.add('on'); obs.unobserve(e.target); } });
  }, { threshold: 0.08 });
  document.querySelectorAll('.fi').forEach(el => obs.observe(el));
  window.addEventListener('load', () => {
    document.querySelectorAll('.fi').forEach(el => {
      if (el.getBoundingClientRect().top < window.innerHeight) el.classList.add('on');
    });
  });
  const burger = document.getElementById('burger');
  const mobileMenu = document.getElementById('mobileMenu');
  burger.addEventListener('click', () => { burger.classList.toggle('open'); mobileMenu.classList.toggle('open'); });
  mobileMenu.querySelectorAll('a').forEach(a => {
    a.addEventListener('click', () => { burger.classList.remove('open'); mobileMenu.classList.remove('open'); });
  });
</script>
</body>
</html>