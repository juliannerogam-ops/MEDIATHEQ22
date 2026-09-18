<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
  session_unset();
  session_destroy();
  header('Location: /MEDIATHEQ22/index.php');
  exit;
}

require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Médiathèque</title>
    <!-- Load CSS -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>/src/css/style.css" />
    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="shortcut icon" type="image/x-icon" href="<?= ROOT_URL ?>/src/images/article1.png" />
</head>
<body>
<nav class="navbar navbar-expand-lg site-header">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= ROOT_URL ?>/index.php">Médiathèque</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/MEDIATHEQ22/index.php">Accueil</a>
        </li>
        <?php if (isset($_SESSION['user'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="/MEDIATHEQ22/views/backend/dashboard.php">Admin</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
    <div class="d-flex align-items-center">

      <?php if (isset($_SESSION['user'])): ?>

        <span class="me-3">
          Bonjour <?= htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']) ?>
        </span>

        <a class="btn btn-danger"
            href="<?= ROOT_URL ?>/views/backend/security/login.php?action=logout">
           Déconnexion
        </a>

      <?php else: ?>

        <a class="btn btn-primary m-1"
            href="<?= ROOT_URL ?>/views/backend/security/login.php">
           Connexion
        </a>

        <a class="btn btn-dark m-1"
            href="<?= ROOT_URL ?>/views/backend/security/signup.php">
           Sign up
        </a>

      <?php endif; ?>

    </div>
  </div>
</nav>