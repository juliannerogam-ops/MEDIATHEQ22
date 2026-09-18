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

$idAlb = (int) ($_POST['idAlb'] ?? 0);
$nomTit = trim($_POST['nomTit'] ?? '');
$dureeTit = filter_var($_POST['dureeTit'] ?? null, FILTER_VALIDATE_FLOAT);

if ($idAlb <= 0 || $nomTit === '' || $dureeTit === false || $dureeTit < 0) {
    header('Location: /MEDIATHEQ22/views/backend/titres/create.php?error=' . urlencode('Les données du titre sont invalides.'));
    exit;
}

if (empty(sql_select('ALBUM', 'idAlb', 'idAlb = ' . $idAlb))) {
    header('Location: /MEDIATHEQ22/views/backend/titres/create.php?error=' . urlencode('Album introuvable.'));
    exit;
}

sql_insert(
    'TITRE',
    'idAlb, nomTit, dureeTit',
    $idAlb . ", '" . str_replace("'", "''", $nomTit) . "', " . (float) $dureeTit
);

header('Location: /MEDIATHEQ22/views/backend/titres/list.php');
exit;