<?php
$conn = new mysqli("localhost", "root", "root", "repair_shop");
if ($conn->connect_error) { die("Connexion échouée"); }
$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nom = trim($_POST['nom'] ?? '');
  $telephone = trim($_POST['telephone'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $type = $_POST['type_reparation'] ?? 'demande_vente';
  $message = trim($_POST['message'] ?? '');
  $stmt = $conn->prepare("INSERT INTO demandes (nom, telephone, email, type_reparation, message) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $nom, $telephone, $email, $type, $message);
  if ($stmt->execute()) { $success = true; }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Vente Téléphone Paris 13 – iPhone & Samsung | 5G Mobile Paris</title>
  <meta name="description" content="Achetez un téléphone neuf ou d'occasion à Paris 13 chez 5G Mobile Paris. iPhone, Samsung disponibles en boutique. Débloqué tout opérateur, facture fournie, garantie incluse. 50 Rue Jenner." />
  <meta name="keywords" content="vente téléphone Paris 13, achat iPhone Paris 13, Samsung occasion Paris 13, téléphone reconditionné Paris 13, 5G Mobile Paris vente, téléphone débloqué Paris 13" />
  <meta name="robots" content="index, follow" />
  <link rel="canonical" href="https://5gmobileparis.fr/vente/" />
  <meta property="og:title" content="Vente Téléphone Paris 13 – 5G Mobile Paris" />
  <meta property="og:description" content="iPhone & Samsung en boutique à Paris 13. Débloqué tout opérateur, garantie incluse, facture fournie. Contactez-nous pour la disponibilité." />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://5gmobileparis.fr/vente/" />
  <script type="application/ld+json">
  {"@context":"https://schema.org","@type":"Store","name":"5G Mobile Paris","description":"Vente et réparation de smartphones à Paris 13.","url":"https://5gmobileparis.fr","telephone":"+33756894694","email":"5gmobileparis@gmail.com","address":{"@type":"PostalAddress","streetAddress":"50 Rue Jenner","addressLocality":"Paris","postalCode":"75013","addressCountry":"FR"},"openingHours":"Mo-Sa 10:30-19:30","aggregateRating":{"@type":"AggregateRating","ratingValue":"4.9","reviewCount":"150"}}
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet" />
  <style>
    :root{--green:#1db954;--green-dark:#148a3d;--black:#ffffff;--dark:#f4faf6;--card:#ffffff;--text:#0f1f12;--muted:#4a7a58;--border:rgba(29,185,84,0.2);}
    *{margin:0;padding:0;box-sizing:border-box;}html{scroll-behavior:smooth;}
    body{font-family:'DM Sans',sans-serif;background:var(--black);color:var(--text);overflow-x:hidden;}

    nav{position:fixed;top:0;left:0;right:0;z-index:200;display:flex;align-items:center;justify-content:space-between;padding:0.9rem 2.5rem;background:rgba(255,255,255,0.95);backdrop-filter:blur(16px);border-bottom:1px solid rgba(29,185,84,0.25);}
    .nav-logo{font-family:'Syne',sans-serif;font-weight:800;font-size:1.25rem;color:var(--green);text-decoration:none;}
    .nav-logo span{color:var(--text);}
    .nav-links{display:flex;gap:2rem;list-style:none;}
    .nav-links a{color:var(--muted);text-decoration:none;font-size:0.88rem;font-weight:500;transition:color .2s;}
    .nav-links a:hover,.nav-links a.active{color:var(--green);}
    .nav-cta{background:var(--green);color:#fff;padding:0.5rem 1.25rem;border-radius:100px;font-weight:700;font-size:0.85rem;text-decoration:none;transition:all .2s;}
    .nav-cta:hover{background:#25d162;transform:translateY(-1px);}

    .top-banner{margin-top:60px;background:var(--green);text-align:center;padding:0.55rem 1rem;font-family:'Syne',sans-serif;font-weight:700;font-size:0.82rem;color:#fff;letter-spacing:0.5px;}

    .marquee{background:var(--green);padding:0.65rem 0;overflow:hidden;white-space:nowrap;}
    .marquee-inner{display:inline-block;animation:slide 22s linear infinite;}
    .marquee-inner span{font-family:'Syne',sans-serif;font-weight:700;font-size:0.8rem;color:#fff;margin:0 2.5rem;letter-spacing:1px;}
    @keyframes slide{from{transform:translateX(0)}to{transform:translateX(-50%)}}

    .page-hero{padding:6rem 5vw 4.5rem;background:var(--dark);position:relative;overflow:hidden;}
    .page-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 70% at 90% 50%,rgba(29,185,84,0.1) 0%,transparent 65%);}
    .page-hero-inner{max-width:1140px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:center;position:relative;z-index:1;}
    .hero-badge{display:inline-flex;align-items:center;gap:0.5rem;background:rgba(29,185,84,0.1);border:1px solid rgba(29,185,84,0.3);border-radius:100px;padding:0.38rem 1rem;font-size:0.78rem;color:var(--green);font-weight:600;letter-spacing:0.5px;margin-bottom:1.2rem;}
    .hero-badge::before{content:'';width:7px;height:7px;background:var(--green);border-radius:50%;animation:blink 2s infinite;}
    @keyframes blink{0%,100%{opacity:1}50%{opacity:0.3}}
    .page-hero h1{font-family:'Syne',sans-serif;font-size:clamp(2.2rem,4.5vw,3.8rem);font-weight:800;letter-spacing:-2px;line-height:1.06;margin-bottom:1rem;}
    .page-hero h1 em{font-style:normal;color:var(--green);}
    .page-hero p{color:var(--muted);font-size:1rem;line-height:1.75;max-width:480px;margin-bottom:1.8rem;}
    .hero-actions{display:flex;gap:1rem;flex-wrap:wrap;}
    .btn-green{background:var(--green);color:#fff;padding:0.8rem 1.8rem;border-radius:100px;font-weight:700;font-size:0.92rem;text-decoration:none;display:inline-flex;align-items:center;gap:0.5rem;transition:all .2s;}
    .btn-green:hover{background:#25d162;transform:translateY(-2px);box-shadow:0 10px 30px rgba(29,185,84,0.25);}
    .btn-outline{border:1.5px solid rgba(29,185,84,0.4);color:var(--green);padding:0.8rem 1.8rem;border-radius:100px;font-weight:600;font-size:0.92rem;text-decoration:none;transition:all .2s;}
    .btn-outline:hover{background:rgba(29,185,84,0.08);transform:translateY(-2px);}

    .hero-visual{position:relative;height:420px;display:flex;align-items:center;justify-content:center;}
    .hero-phone-stack{position:relative;width:280px;height:380px;}
    .phone-card-visual{position:absolute;width:200px;background:var(--card);border-radius:24px;padding:1.2rem;box-shadow:0 20px 50px rgba(0,0,0,0.1);border:1px solid var(--border);}
    .phone-card-visual:nth-child(1){left:0;top:20px;transform:rotate(-6deg);z-index:1;animation:float1 6s ease-in-out infinite;}
    .phone-card-visual:nth-child(2){left:50%;transform:translateX(-50%) rotate(0deg);top:0;z-index:3;animation:float2 6s ease-in-out infinite;}
    .phone-card-visual:nth-child(3){right:0;top:20px;transform:rotate(6deg);z-index:1;animation:float3 6s ease-in-out infinite;}
    @keyframes float1{0%,100%{transform:rotate(-6deg) translateY(0)}50%{transform:rotate(-6deg) translateY(-10px)}}
    @keyframes float2{0%,100%{transform:translateX(-50%) translateY(0)}50%{transform:translateX(-50%) translateY(-14px)}}
    @keyframes float3{0%,100%{transform:rotate(6deg) translateY(0)}50%{transform:rotate(6deg) translateY(-10px)}}
    .pcv-brand{font-size:0.65rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem;}
    .pcv-name{font-family:'Syne',sans-serif;font-weight:800;font-size:0.95rem;color:var(--text);margin-bottom:0.2rem;}
    .pcv-price{font-family:'Syne',sans-serif;font-weight:800;font-size:1.2rem;color:var(--green);}
    .pcv-icon{font-size:2.5rem;text-align:center;margin-bottom:0.6rem;}
    .pcv-tag{display:inline-block;background:rgba(29,185,84,0.1);color:var(--green);font-size:0.65rem;font-weight:700;padding:0.2rem 0.5rem;border-radius:100px;margin-top:0.4rem;}

    .section{padding:5rem 5vw;}.max{max-width:1140px;margin:0 auto;}
    .section-label{font-size:0.72rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--green);margin-bottom:0.6rem;}
    .section-title{font-family:'Syne',sans-serif;font-size:clamp(1.8rem,3.5vw,2.6rem);font-weight:800;letter-spacing:-1px;line-height:1.1;margin-bottom:0.8rem;}
    .section-sub{color:var(--muted);font-size:0.95rem;line-height:1.75;max-width:560px;margin-bottom:2.5rem;}

    .avantages-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1.2rem;margin-bottom:3rem;}
    .avantage{background:var(--card);border:1px solid var(--border);border-radius:18px;padding:1.6rem;box-shadow:0 2px 12px rgba(0,0,0,0.05);transition:all .3s;position:relative;overflow:hidden;}
    .avantage::after{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:var(--green);transform:scaleX(0);transform-origin:left;transition:transform .3s;}
    .avantage:hover{transform:translateY(-4px);border-color:rgba(29,185,84,0.35);box-shadow:0 16px 40px rgba(0,0,0,0.08);}
    .avantage:hover::after{transform:scaleX(1);}
    .avantage-icon{font-size:2rem;margin-bottom:0.8rem;}
    .avantage-title{font-family:'Syne',sans-serif;font-weight:700;font-size:0.95rem;margin-bottom:0.3rem;}
    .avantage-desc{color:var(--muted);font-size:0.82rem;line-height:1.6;}

    .phones-section{background:var(--dark);}
    .phones-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;}
    .phone-card{background:var(--card);border:1px solid var(--border);border-radius:24px;overflow:hidden;transition:all .4s;box-shadow:0 4px 20px rgba(0,0,0,0.06);position:relative;}
    .phone-card:hover{transform:translateY(-8px);box-shadow:0 24px 60px rgba(0,0,0,0.12);border-color:rgba(29,185,84,0.4);}
    .phone-card.featured{border-color:var(--green);border-width:2px;}
    .featured-badge{position:absolute;top:1rem;right:1rem;background:var(--green);color:#fff;font-family:'Syne',sans-serif;font-weight:800;font-size:0.7rem;padding:0.3rem 0.7rem;border-radius:100px;letter-spacing:0.5px;z-index:2;}
    .phone-img-zone{height:220px;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;}
    .phone-emoji{font-size:5rem;filter:drop-shadow(0 8px 20px rgba(0,0,0,0.15));transition:transform .4s;position:relative;z-index:1;}
    .phone-card:hover .phone-emoji{transform:scale(1.08) translateY(-5px);}
    .phone-info{padding:1.5rem;}
    .phone-brand-tag{font-size:0.7rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--muted);margin-bottom:0.3rem;}
    .phone-name{font-family:'Syne',sans-serif;font-weight:800;font-size:1.2rem;margin-bottom:0.5rem;}
    .phone-specs-row{display:flex;gap:0.5rem;flex-wrap:wrap;margin-bottom:1rem;}
    .spec-chip{background:var(--dark);color:var(--muted);font-size:0.72rem;font-weight:600;padding:0.22rem 0.6rem;border-radius:100px;border:1px solid var(--border);}
    .phone-bottom{display:flex;align-items:center;justify-content:space-between;}
    .phone-price-old{font-size:0.78rem;color:var(--muted);text-decoration:line-through;margin-bottom:0.1rem;}
    .phone-price{font-family:'Syne',sans-serif;font-weight:800;font-size:1.5rem;color:var(--green);}
    .phone-etat{display:inline-flex;align-items:center;gap:0.3rem;font-size:0.72rem;font-weight:700;margin-top:0.3rem;}
    .etat-dot{width:7px;height:7px;border-radius:50%;}
    .btn-dispo{background:var(--green);color:#fff;border:none;padding:0.65rem 1.2rem;border-radius:100px;font-family:'Syne',sans-serif;font-weight:700;font-size:0.82rem;cursor:pointer;transition:all .2s;white-space:nowrap;}
    .btn-dispo:hover{background:#25d162;transform:translateY(-1px);}

    .autres-section{background:var(--black);}
    .autres-inner{display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:start;}
    .autres-text h2{font-family:'Syne',sans-serif;font-size:clamp(1.8rem,3vw,2.4rem);font-weight:800;letter-spacing:-1px;line-height:1.1;margin-bottom:1rem;}
    .autres-text p{color:var(--muted);font-size:0.97rem;line-height:1.85;margin-bottom:1rem;}
    .autres-text p strong{color:var(--text);}
    .marques-chips{display:flex;gap:0.6rem;flex-wrap:wrap;margin:1.5rem 0;}
    .marque-chip{display:flex;align-items:center;gap:0.5rem;background:var(--dark);border:1px solid var(--border);border-radius:100px;padding:0.4rem 1rem;font-size:0.82rem;font-weight:600;color:var(--text);transition:all .2s;}
    .marque-chip:hover{border-color:var(--green);color:var(--green);}

    .form-dispo{background:var(--card);border:1px solid var(--border);border-radius:24px;padding:2rem;box-shadow:0 4px 24px rgba(0,0,0,0.06);}
    .form-dispo-title{font-family:'Syne',sans-serif;font-weight:800;font-size:1.2rem;margin-bottom:0.4rem;}
    .form-dispo-sub{color:var(--muted);font-size:0.85rem;margin-bottom:1.5rem;line-height:1.6;}
    .fg{margin-bottom:1rem;}
    .fg label{display:block;font-size:0.75rem;color:var(--muted);margin-bottom:0.3rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;}
    .fg input,.fg textarea,.fg select{width:100%;background:var(--dark);border:1px solid var(--border);border-radius:10px;padding:0.72rem 1rem;color:var(--text);font-family:'DM Sans',sans-serif;font-size:0.9rem;outline:none;transition:border-color .2s;}
    .fg input:focus,.fg textarea:focus,.fg select:focus{border-color:var(--green);background:#fff;}
    .fg textarea{resize:vertical;min-height:90px;}
    .form-row2{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
    .btn-send{width:100%;background:var(--green);color:#fff;border:none;padding:0.88rem;border-radius:100px;font-family:'Syne',sans-serif;font-weight:700;font-size:0.95rem;cursor:pointer;transition:all .2s;}
    .btn-send:hover{background:#25d162;transform:translateY(-1px);}
    .or-divider{display:flex;align-items:center;gap:1rem;margin:1.2rem 0;}
    .or-divider::before,.or-divider::after{content:'';flex:1;height:1px;background:var(--border);}
    .or-divider span{font-size:0.78rem;color:var(--muted);font-weight:600;}
    .btn-whatsapp{width:100%;background:#25d366;color:#fff;border:none;padding:0.88rem;border-radius:100px;font-family:'Syne',sans-serif;font-weight:700;font-size:0.95rem;cursor:pointer;transition:all .2s;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:0.5rem;}
    .btn-whatsapp:hover{background:#20b358;transform:translateY(-1px);}
    .btn-phone-big{width:100%;background:var(--dark);color:var(--text);border:1.5px solid var(--border);padding:0.88rem;border-radius:100px;font-family:'Syne',sans-serif;font-weight:700;font-size:0.95rem;cursor:pointer;transition:all .2s;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:0.5rem;margin-top:0.7rem;}
    .btn-phone-big:hover{border-color:var(--green);color:var(--green);transform:translateY(-1px);}

    .confiance-bg{background:var(--dark);}
    .confiance-grid{display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;}
    .confiance-text p{color:var(--muted);font-size:0.97rem;line-height:1.85;margin-bottom:1rem;}
    .confiance-text p strong{color:var(--text);}
    .confiance-list{margin-top:1.5rem;}
    .confiance-item{display:flex;align-items:flex-start;gap:0.8rem;margin-bottom:0.8rem;}
    .c-check{width:22px;height:22px;background:rgba(29,185,84,0.12);border:1px solid rgba(29,185,84,0.3);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.7rem;color:var(--green);flex-shrink:0;margin-top:2px;}
    .c-text{font-size:0.9rem;color:var(--text);font-weight:500;line-height:1.5;}
    .confiance-cards{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
    .conf-card{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:1.4rem;box-shadow:0 2px 12px rgba(0,0,0,0.05);transition:all .3s;}
    .conf-card:hover{transform:translateY(-3px);border-color:rgba(29,185,84,0.35);}
    .conf-icon{font-size:1.8rem;margin-bottom:0.6rem;}
    .conf-title{font-family:'Syne',sans-serif;font-weight:700;font-size:0.9rem;margin-bottom:0.3rem;}
    .conf-desc{color:var(--muted);font-size:0.8rem;line-height:1.5;}

    .modal-bg{display:none;position:fixed;inset:0;background:rgba(0,0,0,0.4);backdrop-filter:blur(4px);z-index:500;align-items:center;justify-content:center;padding:1rem;}
    .modal-bg.open{display:flex;}
    .modal{background:#fff;border:1px solid var(--border);border-radius:24px;padding:2rem;max-width:460px;width:100%;position:relative;box-shadow:0 30px 80px rgba(0,0,0,0.15);animation:modalIn .3s ease;}
    @keyframes modalIn{from{opacity:0;transform:translateY(20px) scale(0.97)}to{opacity:1;transform:translateY(0) scale(1)}}
    .modal-close{position:absolute;top:1rem;right:1rem;background:var(--dark);border:none;color:var(--muted);font-size:1.1rem;cursor:pointer;width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;transition:all .2s;}
    .modal-close:hover{background:rgba(29,185,84,0.1);color:var(--green);}
    .modal-phone-name{font-family:'Syne',sans-serif;font-weight:800;font-size:1.3rem;margin-bottom:0.2rem;}
    .modal-phone-price{color:var(--green);font-family:'Syne',sans-serif;font-weight:800;font-size:1.6rem;margin-bottom:1.5rem;}

    .success-banner{background:#f0faf4;border:1.5px solid var(--green);border-radius:14px;padding:1rem 1.4rem;margin-bottom:1.5rem;color:var(--green);font-weight:700;font-size:0.92rem;display:flex;align-items:center;gap:0.6rem;}

    .cta-band{background:var(--green);padding:3.5rem 5vw;text-align:center;}
    .cta-band h2{font-family:'Syne',sans-serif;font-size:clamp(1.6rem,3vw,2.2rem);font-weight:800;color:#fff;margin-bottom:0.5rem;letter-spacing:-0.5px;}
    .cta-band p{color:rgba(255,255,255,0.8);margin-bottom:1.8rem;font-size:0.95rem;}
    .cta-actions{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;}
    .cta-btn-white{background:#fff;color:var(--green);padding:0.85rem 2rem;border-radius:100px;font-weight:700;font-size:0.95rem;text-decoration:none;display:inline-flex;align-items:center;gap:0.5rem;transition:all .2s;}
    .cta-btn-white:hover{background:#f0faf2;transform:translateY(-2px);}
    .cta-btn-outline-w{border:2px solid rgba(255,255,255,0.5);color:#fff;padding:0.85rem 2rem;border-radius:100px;font-weight:600;font-size:0.95rem;text-decoration:none;display:inline-flex;align-items:center;gap:0.5rem;transition:all .2s;}
    .cta-btn-outline-w:hover{background:rgba(255,255,255,0.1);transform:translateY(-2px);}

    footer{background:#f0f8f2;border-top:1px solid var(--border);padding:2rem 5vw;}
    .footer-inner{max-width:1140px;margin:0 auto;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;}
    .footer-logo{font-family:'Syne',sans-serif;font-weight:800;color:var(--green);font-size:1.05rem;}
    .footer-logo span{color:var(--muted);}
    .footer-copy{font-size:0.78rem;color:var(--muted);}
    .footer-links{display:flex;gap:1.5rem;list-style:none;}
    .footer-links a{font-size:0.8rem;color:var(--muted);text-decoration:none;}
    .footer-links a:hover{color:var(--green);}

    .fi{opacity:0;transform:translateY(22px);transition:opacity .6s ease,transform .6s ease;}
    .fi.on{opacity:1;transform:translateY(0);}

    @media(max-width:960px){
      nav{padding:0.9rem 1.2rem;}.nav-links{display:none;}
      .section{padding:3.5rem 1.2rem;}.page-hero{padding:5rem 1.2rem 3rem;}
      .page-hero-inner,.autres-inner,.confiance-grid{grid-template-columns:1fr;}
      .hero-visual{display:none;}
      .phones-grid{grid-template-columns:1fr;}
    }
    @media(max-width:600px){
      .form-row2{grid-template-columns:1fr;}
      .confiance-cards{grid-template-columns:1fr;}
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
    <li><a href="vente.php" class="active">Vente</a></li>
    <li><a href="contact.php">Contact</a></li>
  </ul>
  <a href="tel:0756894694" class="nav-cta">📞 07 56 89 46 94</a>
</nav>

<div class="top-banner">📱 Téléphones débloqués tout opérateur · Facture fournie · Garantie incluse · Paris 13ème</div>

<!-- HERO -->
<div class="page-hero">
  <div class="page-hero-inner">
    <div>
      <div class="hero-badge fi">iPhone & Samsung disponibles en boutique</div>
      <h1 class="fi">Achetez votre <em>téléphone</em><br/>à Paris 13</h1>
      <p class="fi">iPhone et Samsung disponibles en boutique, débloqués tout opérateur. Facture fournie, garantie incluse, prêt à l'usage immédiatement. Repartez avec votre téléphone le jour même.</p>
      <div class="hero-actions fi">
        <a href="#catalogue" class="btn-green">📱 Voir les modèles</a>
        <a href="tel:0756894694" class="btn-outline">📞 Vérifier la dispo</a>
      </div>
    </div>
    <div class="hero-visual fi">
      <div class="hero-phone-stack">
        <div class="phone-card-visual">
          <div class="pcv-icon">📱</div>
          <div class="pcv-brand">Apple</div>
          <div class="pcv-name">iPhone 14</div>
          <div class="pcv-price">429 €</div>
          <span class="pcv-tag">Disponible</span>
        </div>
        <div class="phone-card-visual">
          <div class="pcv-icon">📱</div>
          <div class="pcv-brand">Apple</div>
          <div class="pcv-name">iPhone 15</div>
          <div class="pcv-price">499 €</div>
          <span class="pcv-tag">⭐ Populaire</span>
        </div>
        <div class="phone-card-visual">
          <div class="pcv-icon">📱</div>
          <div class="pcv-brand">Samsung</div>
          <div class="pcv-name">Galaxy S23</div>
          <div class="pcv-price">399 €</div>
          <span class="pcv-tag">Disponible</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MARQUEE -->
<div class="marquee">
  <div class="marquee-inner">
    <span>✦ DÉBLOQUÉ TOUT OPÉRATEUR</span><span>✦ FACTURE FOURNIE</span><span>✦ GARANTIE INCLUSE</span>
    <span>✦ DISPONIBLE IMMÉDIATEMENT</span><span>✦ PARIS 13ÈME</span><span>✦ PRIX HONNÊTES</span>
    <span>✦ DÉBLOQUÉ TOUT OPÉRATEUR</span><span>✦ FACTURE FOURNIE</span><span>✦ GARANTIE INCLUSE</span>
    <span>✦ DISPONIBLE IMMÉDIATEMENT</span><span>✦ PARIS 13ÈME</span><span>✦ PRIX HONNÊTES</span>
    <span>✦ DÉBLOQUÉ TOUT OPÉRATEUR</span><span>✦ FACTURE FOURNIE</span><span>✦ GARANTIE INCLUSE</span>
    <span>✦ DISPONIBLE IMMÉDIATEMENT</span><span>✦ PARIS 13ÈME</span><span>✦ PRIX HONNÊTES</span>
  </div>
</div>

<!-- AVANTAGES -->
<section class="section" style="background:var(--black)">
  <div class="max">
    <div class="section-label fi">Pourquoi acheter chez nous</div>
    <h2 class="section-title fi">Votre achat en toute confiance<br/>chez 5G Mobile Paris</h2>
    <p class="section-sub fi">Tous nos téléphones sont contrôlés, débloqués et prêts à l'emploi. Repartez le jour même avec votre téléphone.</p>
    <div class="avantages-grid">
      <div class="avantage fi"><div class="avantage-icon">🔓</div><div class="avantage-title">Débloqué tout opérateur</div><div class="avantage-desc">Tous nos téléphones fonctionnent avec n'importe quel opérateur — Free, SFR, Orange, Bouygues.</div></div>
      <div class="avantage fi"><div class="avantage-icon">🧾</div><div class="avantage-title">Facture fournie</div><div class="avantage-desc">Vous repartez avec une facture officielle pour chaque achat. Transparent et sécurisé.</div></div>
      <div class="avantage fi"><div class="avantage-icon">🛡️</div><div class="avantage-title">Garantie incluse</div><div class="avantage-desc">Chaque téléphone vendu est garanti. En cas de problème, on s'en occupe.</div></div>
      <div class="avantage fi"><div class="avantage-icon">⚡</div><div class="avantage-title">Disponible immédiatement</div><div class="avantage-desc">Pas d'attente, pas de livraison. Vous repartez avec votre téléphone prêt à l'usage le jour même.</div></div>
      <div class="avantage fi"><div class="avantage-icon">💬</div><div class="avantage-title">WhatsApp réactif</div><div class="avantage-desc">Contactez-nous sur WhatsApp pour vérifier la disponibilité d'un modèle en quelques minutes.</div></div>
      <div class="avantage fi"><div class="avantage-icon">🚇</div><div class="avantage-title">Paris 13ème — Métro 5 & 6</div><div class="avantage-desc">Boutique facilement accessible, proche des métros lignes 5 et 6, 50 Rue Jenner.</div></div>
    </div>
  </div>
</section>

<!-- CATALOGUE -->
<section id="catalogue" class="section phones-section">
  <div class="max">
    <div class="section-label fi">Modèles disponibles</div>
    <h2 class="section-title fi">Nos téléphones <span style="color:var(--green)">en ce moment</span></h2>
    <p class="section-sub fi">Quelques modèles actuellement disponibles en boutique. Le stock évolue régulièrement — contactez-nous pour connaître la disponibilité exacte et les dernières arrivées.</p>

    <div class="phones-grid">

      <div class="phone-card featured fi">
        <div class="featured-badge">⭐ Populaire</div>
        <div class="phone-img-zone" style="background:linear-gradient(135deg,#f0faf6,#d4f0de)">
          <div class="phone-emoji">📱</div>
        </div>
        <div class="phone-info">
          <div class="phone-brand-tag">Apple</div>
          <div class="phone-name">iPhone 15</div>
          <div class="phone-specs-row">
            <span class="spec-chip">128 Go</span>
            <span class="spec-chip">USB-C</span>
            <span class="spec-chip">Face ID</span>
            <span class="spec-chip">Tous les coloris</span>
          </div>
          <div class="phone-bottom">
            <div class="phone-price-block">
              <div class="phone-price-old">869 €</div>
              <div class="phone-price">499 €</div>
              <div class="phone-etat"><span class="etat-dot" style="background:#1db954"></span><span style="color:#1db954;font-size:0.72rem;font-weight:700;">Excellent état</span></div>
            </div>
            <button class="btn-dispo" onclick="ouvrirModal('iPhone 15 – 128 Go', '499 €')">Je suis intéressé</button>
          </div>
        </div>
      </div>

      <div class="phone-card fi">
        <div class="phone-img-zone" style="background:linear-gradient(135deg,#f5f0fa,#e0d4f5)">
          <div class="phone-emoji">📱</div>
        </div>
        <div class="phone-info">
          <div class="phone-brand-tag">Apple</div>
          <div class="phone-name">iPhone 14 Pro</div>
          <div class="phone-specs-row">
            <span class="spec-chip">128 Go</span>
            <span class="spec-chip">Lightning</span>
            <span class="spec-chip">Face ID</span>
            <span class="spec-chip">Tous les coloris</span>
          </div>
          <div class="phone-bottom">
            <div class="phone-price-block">
              <div class="phone-price-old">699 €</div>
              <div class="phone-price">479 €</div>
              <div class="phone-etat"><span class="etat-dot" style="background:#1db954"></span><span style="color:#1db954;font-size:0.72rem;font-weight:700;">Excellent état</span></div>
            </div>
            <button class="btn-dispo" onclick="ouvrirModal('iPhone 14 Pro – 128 Go', '479 €')">Je suis intéressé</button>
          </div>
        </div>
      </div>

      <div class="phone-card fi">
        <div class="phone-img-zone" style="background:linear-gradient(135deg,#f0f5fa,#d4e0f5)">
          <div class="phone-emoji">📱</div>
        </div>
        <div class="phone-info">
          <div class="phone-brand-tag">Apple</div>
          <div class="phone-name">iPhone 12</div>
          <div class="phone-specs-row">
            <span class="spec-chip">64 Go</span>
            <span class="spec-chip">Lightning</span>
            <span class="spec-chip">Face ID</span>
            <span class="spec-chip">Tous les coloris</span>
          </div>
          <div class="phone-bottom">
            <div class="phone-price-block">
              <div class="phone-price-old">499 €</div>
              <div class="phone-price">229 €</div>
              <div class="phone-etat"><span class="etat-dot" style="background:#ffc107"></span><span style="color:#e6a800;font-size:0.72rem;font-weight:700;">Excellent état</span></div>
            </div>
            <button class="btn-dispo" onclick="ouvrirModal('iPhone 12 – 64 Go', '229 €')">Je suis intéressé</button>
          </div>
        </div>
      </div>

    </div>

    <div style="margin-top:1.8rem;background:rgba(29,185,84,0.07);border:1px solid rgba(29,185,84,0.2);border-radius:14px;padding:1.2rem 1.5rem;display:flex;align-items:center;gap:1rem;" class="fi">
      <span style="font-size:1.5rem;">📦</span>
      <div>
        <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:0.9rem;margin-bottom:0.2rem;">Stock mis à jour régulièrement</div>
        <div style="font-size:0.83rem;color:var(--muted);">Les modèles affichés sont donnés à titre indicatif. Contactez-nous pour connaître les disponibilités exactes et les dernières arrivées en boutique.</div>
      </div>
    </div>
  </div>
</section>

<!-- AUTRES MODÈLES + FORMULAIRE -->
<section class="section autres-section">
  <div class="max">
    <div class="autres-inner">
      <div class="autres-text fi">
        <div class="section-label">Vous ne trouvez pas votre modèle ?</div>
        <h2>On recherche<br/>le téléphone<br/><span style="color:var(--green)">qu'il vous faut</span></h2>
        <p>Notre stock évolue en permanence. Si vous recherchez un modèle précis qui n'est pas affiché, <strong>contactez-nous directement</strong> — on vous dit si on l'a en boutique ou si on peut vous le procurer.</p>
        <p>On propose des iPhone et Samsung de <strong>toutes générations</strong>, mais aussi d'autres marques selon les arrivages. Appelez-nous, écrivez-nous sur WhatsApp ou remplissez le formulaire — on vous répond rapidement.</p>
        <div class="marques-chips">
          <span class="marque-chip">🍎 iPhone</span>
          <span class="marque-chip">🌀 Samsung</span>
          <span class="marque-chip">🔴 Xiaomi</span>
          <span class="marque-chip">🌸 Huawei</span>
          <span class="marque-chip">📱 Autres</span>
        </div>
        <div style="display:flex;gap:1rem;flex-wrap:wrap;margin-top:0.5rem;">
          <a href="tel:0756894694" class="btn-green">📞 Appeler directement</a>
          <a href="https://wa.me/33756894694" target="_blank" class="btn-outline" style="display:inline-flex;align-items:center;gap:0.5rem;">💬 WhatsApp</a>
        </div>
      </div>

      <div class="fi">
        <div class="form-dispo">
          <div class="form-dispo-title">🔎 Vérifier la disponibilité</div>
          <div class="form-dispo-sub">Dites-nous quel modèle vous recherchez. On vous répond rapidement.</div>

          <?php if ($success): ?>
          <div class="success-banner">✅ Demande envoyée ! On vous répond très vite.</div>
          <?php endif; ?>

          <form method="POST">
            <input type="hidden" name="type_reparation" value="demande_vente" />
            <div class="form-row2">
              <div class="fg">
                <label>Votre nom</label>
                <input type="text" name="nom" required />
              </div>
              <div class="fg">
                <label>Téléphone</label>
                <input type="tel" name="telephone" required />
              </div>
            </div>
            <div class="fg">
              <label>Email</label>
              <input type="email" name="email" />
            </div>
            <div class="fg">
              <label>Modèle recherché</label>
              <textarea name="message" placeholder="Ex : iPhone 13, 128 Go, noir..."></textarea>
            </div>
            <button class="btn-send" type="submit">Envoyer ma demande →</button>
          </form>

          <div class="or-divider"><span>ou contactez-nous directement</span></div>
          <a href="https://wa.me/33756894694" target="_blank" class="btn-whatsapp">💬 Écrire sur WhatsApp</a>
          <a href="tel:0756894694" class="btn-phone-big">📞 07 56 89 46 94</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ACHAT EN CONFIANCE -->
<section class="section confiance-bg">
  <div class="max">
    <div class="confiance-grid">
      <div class="confiance-text fi">
        <div class="section-label">Achat en toute confiance</div>
        <h2 class="section-title">Votre achat sécurisé<br/>chez 5G Mobile Paris</h2>
        <p>Chez <strong>5G Mobile Paris</strong>, tous nos téléphones sont <strong>débloqués tout opérateur</strong> et livrés avec une facture. Nous proposons des modèles récents, testés et prêts à l'usage.</p>
        <p>Vous venez en boutique au <strong>50 Rue Jenner, Paris 13ème</strong> et vous repartez avec votre téléphone le jour même — sans attente, sans livraison, sans mauvaise surprise.</p>
        <div class="confiance-list">
          <div class="confiance-item"><div class="c-check">✓</div><div class="c-text">Téléphones testés et vérifiés avant la vente</div></div>
          <div class="confiance-item"><div class="c-check">✓</div><div class="c-text">Débloqué tout opérateur — fonctionne avec toutes les SIM</div></div>
          <div class="confiance-item"><div class="c-check">✓</div><div class="c-text">Facture officielle fournie à chaque achat</div></div>
          <div class="confiance-item"><div class="c-check">✓</div><div class="c-text">Service client réactif via WhatsApp</div></div>
          <div class="confiance-item"><div class="c-check">✓</div><div class="c-text">Proche métros 5 &amp; 6 — Paris 13ème</div></div>
        </div>
      </div>
      <div class="confiance-cards fi">
        <div class="conf-card"><div class="conf-icon">📦</div><div class="conf-title">Modèles récents</div><div class="conf-desc">Disponibles sans attente, prêts à l'usage dès l'achat en boutique.</div></div>
        <div class="conf-card"><div class="conf-icon">💬</div><div class="conf-title">WhatsApp réactif</div><div class="conf-desc">Service client rapide et réactif. On répond dans la journée.</div></div>
        <div class="conf-card"><div class="conf-icon">🛡️</div><div class="conf-title">Garantie & transparence</div><div class="conf-desc">Facture fournie, garantie incluse. Aucune mauvaise surprise.</div></div>
        <div class="conf-card"><div class="conf-icon">🚇</div><div class="conf-title">Facile d'accès</div><div class="conf-desc">Paris 13ème · 50 Rue Jenner · Métros lignes 5 &amp; 6.</div></div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<div class="cta-band">
  <div style="max-width:1140px;margin:0 auto;">
    <h2>Vous cherchez un téléphone ?</h2>
    <p>Venez en boutique ou contactez-nous — on vérifie la dispo en quelques minutes.</p>
    <div class="cta-actions">
      <a href="tel:0756894694" class="cta-btn-white">📞 07 56 89 46 94</a>
      <a href="https://wa.me/33756894694" target="_blank" class="cta-btn-outline-w">💬 WhatsApp</a>
    </div>
  </div>
</div>

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

<!-- MODAL -->
<div class="modal-bg" id="modal">
  <div class="modal">
    <button class="modal-close" onclick="fermerModal()">✕</button>
    <div style="font-size:2.5rem;margin-bottom:0.5rem;">📱</div>
    <div class="modal-phone-name" id="modal-titre">Modèle</div>
    <div class="modal-phone-price" id="modal-prix">0 €</div>

    <form method="POST">
      <input type="hidden" name="type_reparation" value="reservation" />
      <div class="fg">
        <label>Votre nom</label>
        <input type="text" name="nom" required />
      </div>
      <div class="fg">
        <label>Téléphone</label>
        <input type="tel" name="telephone" required />
      </div>
      <div class="fg">
        <label>Email</label>
        <input type="email" name="email" />
      </div>
      <div class="fg">
        <label>Message</label>
        <textarea name="message"></textarea>
      </div>
      <button class="btn-send" type="submit">Réserver ce téléphone →</button>
    </form>

    <div class="or-divider"><span>ou</span></div>
    <a href="https://wa.me/33756894694" target="_blank" class="btn-whatsapp">💬 Contacter sur WhatsApp</a>
  </div>
</div>

<script>
  const obs = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('on'); obs.unobserve(e.target); }});
  }, { threshold: 0, rootMargin: '0px 0px -20px 0px' });
  document.querySelectorAll('.fi').forEach(el => obs.observe(el));

  // Déclenche immédiatement les éléments déjà visibles
  window.addEventListener('load', () => {
    document.querySelectorAll('.fi').forEach(el => {
      const rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight) el.classList.add('on');
    });
  });

  function ouvrirModal(titre, prix) {
    document.getElementById('modal-titre').textContent = titre;
    document.getElementById('modal-prix').textContent = prix;
    document.getElementById('modal').classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function fermerModal() {
    document.getElementById('modal').classList.remove('open');
    document.body.style.overflow = '';
  }

  document.getElementById('modal').addEventListener('click', function(e) {
    if(e.target === this) fermerModal();
  });

  document.addEventListener('keydown', e => { if(e.key === 'Escape') fermerModal(); });
</script>
</body>
</html>