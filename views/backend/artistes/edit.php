<?php
include '../../../header.php';

$idArt = (int) ($_GET['idArt'] ?? 0);
$artisteResult = $idArt > 0 ? sql_select('ARTISTE', '*', 'idArt = ' . $idArt) : [];
$artiste = $artisteResult[0] ?? null;
$groupes = sql_select('GROUPE', 'idGp, nomGp', '', '', 'nomGp ASC');

if (!$artiste) {
    echo '<main class="container my-5"><div class="alert alert-danger">Artiste introuvable.</div></main>';
    include '../../../footer.php';
    exit;
}
?>

<main class="container my-5">
    <h1>Modifier un artiste</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="<?= ROOT_URL ?>/api/artistes/update.php" method="post">
        <input type="hidden" name="idArt" value="<?= (int) $artiste['idArt'] ?>">

        <div class="mb-3">
            <label for="idGp" class="form-label">Groupe</label>
            <select id="idGp" name="idGp" class="form-select" required>
                <?php foreach ($groupes as $groupe): ?>
                    <option value="<?= (int) $groupe['idGp'] ?>" <?= (int) $groupe['idGp'] === (int) $artiste['idGp'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($groupe['nomGp']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="prenomArt" class="form-label">Prénom</label>
            <input id="prenomArt" name="prenomArt" class="form-control" type="text" value="<?= htmlspecialchars($artiste['prenomArt']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="nomArt" class="form-label">Nom</label>
            <input id="nomArt" name="nomArt" class="form-control" type="text" value="<?= htmlspecialchars($artiste['nomArt']) ?>" required>
        </div>

        <a href="list.php" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</main>

<?php include '../../../footer.php'; ?>