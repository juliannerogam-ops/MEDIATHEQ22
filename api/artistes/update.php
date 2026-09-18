<?php
session_start();
require_once dirname(__DIR__, 2) . '/config.php';

if (!isset($_SESSION['user'])) {
    header('Location: /MEDIATHEQ22/views/backend/security/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /MEDIATHEQ22/views/backend/artistes/list.php');
    exit;
}

$idArt = (int) ($_POST['idArt'] ?? 0);
$idGp = (int) ($_POST['idGp'] ?? 0);
$nomArt = trim($_POST['nomArt'] ?? '');
$prenomArt = trim($_POST['prenomArt'] ?? '');

if ($idArt <= 0 || $nomArt === '' || $prenomArt === '') {
    header('Location: /MEDIATHEQ22/views/backend/artistes/list.php?error=' . urlencode('Les données de l artiste sont invalides.'));
    exit;
}

if (empty(sql_select('ARTISTE', 'idArt', 'idArt = ' . $idArt)) || ($idGp > 0 && empty(sql_select('GROUPE', 'idGp', 'idGp = ' . $idGp)))) {
    header('Location: /MEDIATHEQ22/views/backend/artistes/list.php?error=' . urlencode('Artiste ou groupe introuvable.'));
    exit;
}

$groupSql = $idGp > 0 ? (string) $idGp : 'NULL';
sql_update(
    'ARTISTE',
    "idGp = $groupSql, nomArt = '" . str_replace("'", "''", $nomArt) . "', prenomArt = '" . str_replace("'", "''", $prenomArt) . "'",
    'idArt = ' . $idArt
);

header('Location: /MEDIATHEQ22/views/backend/artistes/list.php');
exit;