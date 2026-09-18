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

$email = trim($_POST['eMailUser'] ?? '');
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: /MEDIATHEQ22/views/backend/users/list.php?error=' . urlencode('Adresse mail invalide.'));
    exit;
}

sql_connect();
global $DB;

$stmt = $DB->prepare('DELETE FROM USER WHERE eMailUser = :email');
$stmt->execute([':email' => $email]);

header('Location: /MEDIATHEQ22/views/backend/users/list.php');
exit;