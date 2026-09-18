<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

if (!isset($_SESSION['user'])) {
    header('Location: /MEDIATHEQ22/views/backend/security/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /MEDIATHEQ22/views/backend/users/list.php');
    exit;
}

$prenom = trim($_POST['prenomUser'] ?? '');
$nom = trim($_POST['nomUser'] ?? '');
$email = trim($_POST['eMailUser'] ?? '');

if ($prenom === '' || $nom === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: /MEDIATHEQ22/views/backend/users/create.php?error=' . urlencode('Les trois champs sont obligatoires et l email doit être valide.'));
    exit;
}

$quotedEmail = str_replace("'", "''", $email);
if (!empty(sql_select('USER', 'eMailUser', "eMailUser = '$quotedEmail'"))) {
    header('Location: /MEDIATHEQ22/views/backend/users/create.php?error=' . urlencode('Cette adresse mail existe déjà.'));
    exit;
}

sql_insert(
    'USER',
    'nomEUser, prenomUser, eMailUser',
    "'" . str_replace("'", "''", $nom) . "', '" . str_replace("'", "''", $prenom) . "', '$quotedEmail'"
);

header('Location: /MEDIATHEQ22/views/backend/users/list.php');
exit;