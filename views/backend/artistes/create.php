<?php
include '../../../header.php';
$groupes = sql_select('GROUPE', 'idGp, nomGp', '', '', 'nomGp ASC');
?>

<main class="container my-5">
    <h1>Créer un artiste</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="<?= ROOT_URL ?>/api/artistes/create.php" method="post">
        <div class="mb-3">
            <label for="idGp" class="form-label">Groupe</label>
            <select id="idGp" name="idGp" class="form-select" required>
                <option value="">-- Choisir un groupe --</option>
                <?php foreach ($groupes as $groupe): ?>
                    <option value="<?= (int) $groupe['idGp'] ?>"><?= htmlspecialchars($groupe['nomGp']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="prenomArt" class="form-label">Prénom</label>
            <input id="prenomArt" name="prenomArt" class="form-control" type="text" required>
        </div>

        <div class="mb-3">
            <label for="nomArt" class="form-label">Nom</label>
            <input id="nomArt" name="nomArt" class="form-control" type="text" required>
        </div>

        <a href="list.php" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</main>

<?php include '../../../footer.php'; ?>