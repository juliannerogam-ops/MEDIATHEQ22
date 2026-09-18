<?php
include '../../../header.php';
?>

<main class="container my-5">
    <h1>Créer un groupe</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="<?= ROOT_URL ?>/api/groupes/create.php" method="post">
        <div class="mb-3">
            <label for="nomGp" class="form-label">Nom du groupe</label>
            <input id="nomGp" name="nomGp" class="form-control" type="text" required>
        </div>

        <div class="mb-3">
            <label for="dtCreaGp" class="form-label">Date de création</label>
            <input id="dtCreaGp" name="dtCreaGp" class="form-control" type="date" required>
        </div>

        <a href="list.php" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</main>

<?php include '../../../footer.php'; ?>