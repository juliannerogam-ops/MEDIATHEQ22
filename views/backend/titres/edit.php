<?php
include '../../../header.php';

$idTit = (int) ($_GET['idTit'] ?? 0);
$titreResult = $idTit > 0 ? sql_select('TITRE', '*', 'idTit = ' . $idTit) : [];
$titre = $titreResult[0] ?? null;
$albums = sql_select('ALBUM', 'idAlb, nomA', '', '', 'nomA ASC');

if (!$titre) {
    echo '<main class="container my-5"><div class="alert alert-danger">Titre introuvable.</div></main>';
    include '../../../footer.php';
    exit;
}
?>

<main class="container my-5">
    <h1>Modifier un titre</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="<?= ROOT_URL ?>/api/titres/update.php" method="post">
        <input type="hidden" name="idTit" value="<?= (int) $titre['idTit'] ?>">

        <div class="mb-3">
            <label for="idAlb" class="form-label">Album</label>
            <select id="idAlb" name="idAlb" class="form-select" required>
                <?php foreach ($albums as $album): ?>
                    <option value="<?= (int) $album['idAlb'] ?>" <?= (int) $album['idAlb'] === (int) $titre['idAlb'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($album['nomA'] ?? 'Album #' . $album['idAlb']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="nomTit" class="form-label">Nom du titre</label>
            <input id="nomTit" name="nomTit" class="form-control" type="text" value="<?= htmlspecialchars($titre['nomTit']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="dureeTit" class="form-label">Durée</label>
            <input id="dureeTit" name="dureeTit" class="form-control" type="number" step="0.01" min="0" value="<?= htmlspecialchars((string) $titre['dureeTit']) ?>" required>
        </div>

        <a href="list.php" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</main>

<?php include '../../../footer.php'; ?>