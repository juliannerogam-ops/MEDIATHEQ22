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
    <h1>Modifier un utilisateur</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="<?= ROOT_URL ?>/api/users/update.php" method="post">
        <input type="hidden" name="originalEmail" value="<?= htmlspecialchars($user['eMailUser']) ?>">

        <div class="mb-3">
            <label for="prenomUser" class="form-label">Prénom</label>
            <input id="prenomUser" name="prenomUser" class="form-control" type="text" value="<?= htmlspecialchars($user['prenomUser']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="nomUser" class="form-label">Nom</label>
            <input id="nomUser" name="nomUser" class="form-control" type="text" value="<?= htmlspecialchars($user['nomEUser']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="eMailUser" class="form-label">Adresse mail</label>
            <input id="eMailUser" name="eMailUser" class="form-control" type="email" value="<?= htmlspecialchars($user['eMailUser']) ?>" required>
        </div>

        <a href="list.php" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</main>

<?php include '../../../footer.php'; ?>