<?php
include '../../../header.php';

if (!isset($_SESSION['user'])) {
    header('Location: /MEDIATHEQ22/views/backend/security/login.php');
    exit;
}
?>

<main class="container my-5">
    <h1>Créer un utilisateur</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="<?= ROOT_URL ?>/api/users/create.php" method="post">
        <div class="mb-3">
            <label for="prenomUser" class="form-label">Prénom</label>
            <input id="prenomUser" name="prenomUser" class="form-control" type="text" required>
        </div>

        <div class="mb-3">
            <label for="nomUser" class="form-label">Nom</label>
            <input id="nomUser" name="nomUser" class="form-control" type="text" required>
        </div>

        <div class="mb-3">
            <label for="eMailUser" class="form-label">Adresse mail</label>
            <input id="eMailUser" name="eMailUser" class="form-control" type="email" required>
        </div>

        <a href="list.php" class="btn btn-primary">Liste</a>
        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</main>

<?php include '../../../footer.php'; ?>