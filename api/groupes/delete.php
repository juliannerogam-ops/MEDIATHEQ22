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
if ($idGp > 0) {
    sql_delete('GROUPE', 'idGp = ' . $idGp);
}

header('Location: /MEDIATHEQ22/views/backend/groupes/list.php');
exit;