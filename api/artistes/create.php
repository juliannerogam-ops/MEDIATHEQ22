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

$idGp = (int) ($_POST['idGp'] ?? 0);
$nomArt = trim($_POST['nomArt'] ?? '');
$prenomArt = trim($_POST['prenomArt'] ?? '');

if ($nomArt === '' || $prenomArt === '') {
    header('Location: /MEDIATHEQ22/views/backend/artistes/create.php?error=' . urlencode('Les données de l artiste sont invalides.'));
    exit;
}

if ($idGp > 0 && empty(sql_select('GROUPE', 'idGp', 'idGp = ' . $idGp))) {
    header('Location: /MEDIATHEQ22/views/backend/artistes/create.php?error=' . urlencode('Groupe introuvable.'));
    exit;
}

if ($idGp > 0) {
    sql_insert(
        'ARTISTE',
        'idGp, nomArt, prenomArt',
        $idGp . ", '" . str_replace("'", "''", $nomArt) . "', '" . str_replace("'", "''", $prenomArt) . "'"
    );
} else {
    sql_insert(
        'ARTISTE',
        'nomArt, prenomArt',
        "'" . str_replace("'", "''", $nomArt) . "', '" . str_replace("'", "''", $prenomArt) . "'"
    );
}

header('Location: /MEDIATHEQ22/views/backend/artistes/list.php');
exit;