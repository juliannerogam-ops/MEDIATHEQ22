<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

if (!isset($_SESSION['user'])) {
    header('Location: /MEDIATHEQ22/views/backend/security/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /MEDIATHEQ22/views/backend/groupes/list.php');
    exit;
}

$nomGp = trim($_POST['nomGp'] ?? '');
$dtCreaGp = trim($_POST['dtCreaGp'] ?? '');

if ($nomGp === '' || !DateTime::createFromFormat('Y-m-d', $dtCreaGp)) {
    header('Location: /MEDIATHEQ22/views/backend/groupes/create.php?error=' . urlencode('Les données du groupe sont invalides.'));
    exit;
}

sql_insert(
    'GROUPE',
    'nomGp, dtCreaGp',
    "'" . str_replace("'", "''", $nomGp) . "', '" . str_replace("'", "''", $dtCreaGp) . "'"
);

header('Location: /MEDIATHEQ22/views/backend/groupes/list.php');
exit;