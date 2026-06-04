5G Mobile Paris — Site Web Sur Mesure

Site web développé from scratch pour 5G Mobile Paris, entreprise spécialisée dans la réparation de smartphones. Ce projet remplace un ancien site WordPress par une solution entièrement personnalisée, plus performante et adaptée aux besoins de l'entreprise.

🔗 Site en ligne : https://5gmobileparis.fr
Présentation du projet

5G Mobile Paris souhaitait améliorer sa visibilité en ligne et faciliter la prise de contact avec ses clients. L'ancien site WordPress présentait plusieurs contraintes : personnalisation limitée, dépendance aux plugins tiers et performances insuffisantes.

La mission a consisté à concevoir et développer un site web sur mesure répondant aux objectifs suivants :

Présenter les services de l'entreprise de façon claire et professionnelle
Permettre aux clients d'envoyer des demandes via un formulaire de contact sécurisé
Offrir un design responsive adapté à tous les appareils
Garantir la sécurité des données saisies
Fonctionnalités

Pages de présentation des services, des réparations et des ventes
Formulaire de contact avec stockage des demandes en base MySQL
Espace administrateur sécurisé (login + système de lockout)
Design responsive : mobile, tablette et desktop
Validation des données côté client (JavaScript) et côté serveur (PHP)
Protection contre les injections SQL via PDO et requêtes préparées
Stack technique

Catégorie	Technologies
Front-end	HTML5, CSS3 (media queries), JavaScript
Back-end	PHP 8
Base de données	MySQL / phpMyAdmin
Déploiement	Hostinger (gestionnaire de fichiers en ligne)
Versioning	Git / GitHub
Éditeur	Visual Studio Code
Tests	Chrome DevTools, Firefox
Structure du projet

5gmobileparis/
├── index.php            # Page d'accueil
├── reparation.php       # Page des services de réparation
├── vente.php            # Page des produits à la vente
├── apropos.php          # Page À propos
├── contact.php          # Page formulaire de contact
├── admin.php            # Interface d'administration (accès restreint)
├── login.php            # Page de connexion administrateur
├── logout.php           # Déconnexion de l'administrateur
├── traitement.php       # Traitement du formulaire de contact (insertion en base)
├── css/
│   └── style.css        # Feuille de styles principale
└── js/
    └── validation.js    # Validation côté client
Base de données

La base de données MySQL contient une table principale demandes :

CREATE TABLE demandes (
    id              INT(11)       AUTO_INCREMENT PRIMARY KEY,
    nom             VARCHAR(100)  NULL,
    telephone       VARCHAR(20)   NULL,
    email           VARCHAR(100)  NULL,
    modele          VARCHAR(255)  NULL,
    type_reparation VARCHAR(100)  NULL,
    message         TEXT          NULL,
    date_demande    TIMESTAMP     DEFAULT current_timestamp()
);
Les insertions sont effectuées via des requêtes préparées MySQLi (prepare / bind_param) pour prévenir les injections SQL.

Schéma applicatif

[ Navigateur client ]
        |
        | Requête HTTP
        ▼
[ Serveur Web — PHP 8 / Hostinger ]
        |
        | Requête PDO préparée
        ▼
[ Base de données MySQL ]
        |
        | Résultat
        ▼
[ Réponse au client ]
Sécurité

Injections SQL : toutes les requêtes utilisent MySQLi avec prepare et bind_param
Validation serveur : vérification des champs avant toute insertion en base
Validation client : contrôles JavaScript pour améliorer l'expérience utilisateur
Espace admin protégé : accès via page de login avec déconnexion sécurisée (logout)
⚠️ À faire en production : remplacer les identifiants root/root de traitement.php par les vrais identifiants Hostinger
Déploiement

Le déploiement est effectué via le gestionnaire de fichiers de l'hébergeur Hostinger, directement depuis l'interface en ligne.

Étapes :

Se connecter à l'espace client Hostinger
Accéder au gestionnaire de fichiers et uploader les fichiers dans le dossier public_html
Importer la base de données via phpMyAdmin (disponible dans le panneau Hostinger)
Vérifier l'accessibilité du site via l'URL publique
Installation locale

Cloner le dépôt :

git clone https://github.com/syrinechf/5gmobileparis.git
Lancer un serveur local (XAMPP, WAMP ou équivalent) et placer le projet dans htdocs.

Importer la base de données dans phpMyAdmin :

Créer une base nommée 5gmobileparis
Exécuter le script SQL de création de la table demandes
Adapter les identifiants de connexion à la base de données dans le fichier PHP concerné.

Ouvrir index.php via le serveur local.

Tests effectués

Navigateurs : Chrome, Firefox
Appareils : desktop, tablette, mobile
Fonctionnalités testées : formulaire de contact, espace admin, login/logout, responsive design, validation des données
Auteur

CHERIF Syrine — BTS SIO option SLAM, session 2026
Réalisation professionnelle n°1 — Épreuve E6