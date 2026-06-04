<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Services – 5G Mobile Paris</title>

  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
</head>

<body>

<!-- NAV -->
<nav>
  <div class="nav-logo">5G <span>Mobile Paris</span></div>
  <ul class="nav-links">
    <li><a href="index.php">Accueil</a></li>
    <li><a href="services.php">Services</a></li>
    <li><a href="tarifs.php">Tarifs</a></li>
    <li><a href="index.php#comment">Comment ça marche</a></li>
    <li><a href="contact.php">Contact</a></li>
  </ul>
  <a href="tel:0756894694" class="nav-cta">📞 07 56 89 46 94</a>
</nav>

<!-- TITRE -->
<h1 style="margin-top:120px;text-align:center;">
  Nos services
</h1>

<!-- MARQUEE -->
<div class="marquee-wrap">
  <div class="marquee-track">
    <span>✦ RÉPARATION EXPRESS</span>
    <span>✦ GARANTIE 6 MOIS</span>
    <span>✦ DEVIS GRATUIT</span>
    <span>✦ TOUTES MARQUES</span>
    <span>✦ PARIS 13ÈME</span>
  </div>
</div>

<!-- SERVICES -->
<section id="services">
  <div class="container">

    <div class="section-label fade-in">Nos services</div>
    <h2 class="section-title fade-in">
      Ce qu'on répare<br />pour vous
    </h2>

    <p class="section-sub fade-in">
      Toutes marques, toutes pannes. iPhone, Samsung, Xiaomi, Huawei et bien plus encore.
    </p>

    <div class="services-grid">

      <div class="service-card fade-in">
        <div class="service-icon">📱</div>
        <div class="service-title">Remplacement d'écran</div>
        <div class="service-desc">
          Écran fissuré ou tactile HS ? Remplacement rapide avec pièces de qualité.
        </div>
        <span class="service-price">Dès 49 €</span>
      </div>

      <div class="service-card fade-in">
        <div class="service-icon">🔋</div>
        <div class="service-title">Remplacement de batterie</div>
        <div class="service-desc">
          Batterie qui se décharge vite ? Remplacement rapide avec batterie certifiée.
        </div>
        <span class="service-price">Dès 39 €</span>
      </div>

      <div class="service-card fade-in">
        <div class="service-icon">🔌</div>
        <div class="service-title">Connecteur de charge</div>
        <div class="service-desc">
          Problème de charge ? Réparation du port Lightning / USB-C.
        </div>
        <span class="service-price">Dès 35 €</span>
      </div>

      <div class="service-card fade-in">
        <div class="service-icon">💧</div>
        <div class="service-title">Dégâts liquides</div>
        <div class="service-desc">
          Téléphone tombé dans l'eau ? Nettoyage et diagnostic complet.
        </div>
        <span class="service-price">Diagnostic gratuit</span>
      </div>

      <div class="service-card fade-in">
        <div class="service-icon">📷</div>
        <div class="service-title">Réparation caméra</div>
        <div class="service-desc">
          Caméra floue ou cassée ? Remplacement du module caméra.
        </div>
        <span class="service-price">Dès 45 €</span>
      </div>

      <div class="service-card fade-in">
        <div class="service-icon">🛠️</div>
        <div class="service-title">Autres réparations</div>
        <div class="service-desc">
          Micro, haut-parleur, boutons… contactez-nous pour un diagnostic.
        </div>
        <span class="service-price">Sur devis</span>
      </div>

    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-inner">
    <div class="footer-logo">5G <span>Mobile Paris</span></div>

    <div class="footer-copy">
      © 2025 5G Mobile Paris – 50 Rue Jenner, 75013 Paris
    </div>

    <div class="footer-links">
      <a href="services.php">Services</a>
      <a href="tarifs.php">Tarifs</a>
      <a href="contact.php">Contact</a>
    </div>
  </div>
</footer>

<script>
const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.1 });

document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
</script>

</body>
</html>