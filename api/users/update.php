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

$originalEmail = trim($_POST['originalEmail'] ?? '');
$prenom = trim($_POST['prenomUser'] ?? '');
$nom = trim($_POST['nomUser'] ?? '');
$email = trim($_POST['eMailUser'] ?? '');

if ($originalEmail === '' || $prenom === '' || $nom === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: /MEDIATHEQ22/views/backend/users/list.php?error=' . urlencode('Données utilisateur invalides.'));
    exit;
}

sql_connect();
global $DB;

$originalEmailQuoted = $DB->quote($originalEmail);
$emailQuoted = $DB->quote($email);
$nomQuoted = $DB->quote($nom);
$prenomQuoted = $DB->quote($prenom);

if ($email !== $originalEmail && !empty(sql_select('USER', 'eMailUser', "eMailUser = $emailQuoted"))) {
    header('Location: /MEDIATHEQ22/views/backend/users/edit.php?eMailUser=' . urlencode($originalEmail) . '&error=' . urlencode('Cette adresse mail existe déjà.'));
    exit;
}

$stmt = $DB->prepare(
    "UPDATE USER SET nomEUser = :nom, prenomUser = :prenom, eMailUser = :email WHERE eMailUser = :originalEmail"
);
$stmt->execute([
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':email' => $email,
    ':originalEmail' => $originalEmail
]);

header('Location: /MEDIATHEQ22/views/backend/users/list.php');
exit;