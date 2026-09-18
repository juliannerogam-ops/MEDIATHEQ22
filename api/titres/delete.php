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
if ($idTit > 0) {
    sql_delete('TITRE', 'idTit = ' . $idTit);
}

header('Location: /MEDIATHEQ22/views/backend/titres/list.php');
exit;