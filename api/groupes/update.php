<?php
session_start();
require_once dirname(__DIR__, 2) . '/config.php';

if (!isset($_SESSION['user'])) {
    header('Location: /MEDIATHEQ22/views/backend/security/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /MEDIATHEQ22/views/backend/groupes/list.php');
    exit;
}

$idGp = (int) ($_POST['idGp'] ?? 0);
$nomGp = trim($_POST['nomGp'] ?? '');
$dtCreaGp = trim($_POST['dtCreaGp'] ?? '');

if ($idGp <= 0 || $nomGp === '' || !DateTime::createFromFormat('Y-m-d', $dtCreaGp)) {
    header('Location: /MEDIATHEQ22/views/backend/groupes/list.php?error=' . urlencode('Les données du groupe sont invalides.'));
    exit;
}

sql_update(
    'GROUPE',
    "nomGp = '" . str_replace("'", "''", $nomGp) . "', dtCreaGp = '" . str_replace("'", "''", $dtCreaGp) . "'",
    'idGp = ' . $idGp
);

header('Location: /MEDIATHEQ22/views/backend/groupes/list.php');
exit;