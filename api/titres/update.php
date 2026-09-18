<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

if (!isset($_SESSION['user'])) {
    header('Location: /MEDIATHEQ22/views/backend/security/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /MEDIATHEQ22/views/backend/titres/list.php');
    exit;
}

$idTit = (int) ($_POST['idTit'] ?? 0);
$idAlb = (int) ($_POST['idAlb'] ?? 0);
$nomTit = trim($_POST['nomTit'] ?? '');
$dureeTit = filter_var($_POST['dureeTit'] ?? null, FILTER_VALIDATE_FLOAT);

if ($idTit <= 0 || $idAlb <= 0 || $nomTit === '' || $dureeTit === false || $dureeTit < 0) {
    header('Location: /MEDIATHEQ22/views/backend/titres/list.php?error=' . urlencode('Les données du titre sont invalides.'));
    exit;
}

if (empty(sql_select('TITRE', 'idTit', 'idTit = ' . $idTit)) || empty(sql_select('ALBUM', 'idAlb', 'idAlb = ' . $idAlb))) {
    header('Location: /MEDIATHEQ22/views/backend/titres/list.php?error=' . urlencode('Titre ou album introuvable.'));
    exit;
}

sql_update(
    'TITRE',
    "idAlb = $idAlb, nomTit = '" . str_replace("'", "''", $nomTit) . "', dureeTit = " . (float) $dureeTit,
    'idTit = ' . $idTit
);

header('Location: /MEDIATHEQ22/views/backend/titres/list.php');
exit;