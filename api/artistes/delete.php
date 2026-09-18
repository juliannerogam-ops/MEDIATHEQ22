<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

if (!isset($_SESSION['user'])) {
    header('Location: /MEDIATHEQ22/views/backend/security/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /MEDIATHEQ22/views/backend/artistes/list.php');
    exit;
}

$idArt = (int) ($_POST['idArt'] ?? 0);
if ($idArt > 0) {
    sql_delete('ARTISTE', 'idArt = ' . $idArt);
}

header('Location: /MEDIATHEQ22/views/backend/artistes/list.php');
exit;