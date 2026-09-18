<?php
include '../../../header.php';

if (!isset($_SESSION['user'])) {
    header('Location: /MEDIATHEQ22/views/backend/security/login.php');
    exit;
}

$email = trim($_GET['eMailUser'] ?? '');
$users = $email === '' ? [] : sql_select(
    'USER',
    'nomEUser, prenomUser, eMailUser',
    "eMailUser = '" . str_replace("'", "''", $email) . "'"
);
$user = $users[0] ?? null;

if (!$user) {
    echo '<main class="container my-5"><div class="alert alert-danger">Utilisateur introuvable.</div></main>';
    include '../../../footer.php';
    exit;
}
?>

<main class="container my-5">
    <h1>Supprimer un utilisateur</h1>

    <div class="mb-3">
        <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenomUser']) ?></p>
        <p><strong>Nom :</strong> <?= htmlspecialchars($user['nomEUser']) ?></p>
        <p><strong>Adresse mail :</strong> <?= htmlspecialchars($user['eMailUser']) ?></p>
    </div>

    <form action="<?= ROOT_URL ?>/api/users/delete.php" method="post">
        <input type="hidden" name="eMailUser" value="<?= htmlspecialchars($user['eMailUser']) ?>">
        <a href="list.php" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
</main>

<?php include '../../../footer.php'; ?>