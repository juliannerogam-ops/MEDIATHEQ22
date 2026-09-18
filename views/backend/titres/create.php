<?php
include '../../../header.php';
$albums = sql_select('ALBUM', 'idAlb, nomA', '', '', 'nomA ASC');
?>

<main class="container my-5">
    <h1>Créer un titre</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="<?= ROOT_URL ?>/api/titres/create.php" method="post">
        <div class="mb-3">
            <label for="idAlb" class="form-label">Album</label>
            <select id="idAlb" name="idAlb" class="form-select" required>
                <option value="">-- Choisir un album --</option>
                <?php foreach ($albums as $album): ?>
                    <option value="<?= (int) $album['idAlb'] ?>">
                        <?= htmlspecialchars($album['nomA'] ?? 'Album #' . $album['idAlb']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="nomTit" class="form-label">Nom du titre</label>
            <input id="nomTit" name="nomTit" class="form-control" type="text" required>
        </div>

        <div class="mb-3">
            <label for="dureeTit" class="form-label">Durée</label>
            <input id="dureeTit" name="dureeTit" class="form-control" type="number" step="0.01" min="0" required>
        </div>

        <a href="list.php" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</main>

<?php include '../../../footer.php'; ?>