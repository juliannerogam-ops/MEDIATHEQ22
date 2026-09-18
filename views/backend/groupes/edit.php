<?php
include '../../../header.php';

$idGp = (int) ($_GET['idGp'] ?? 0);
$groupeResult = $idGp > 0 ? sql_select('GROUPE', '*', 'idGp = ' . $idGp) : [];
$groupe = $groupeResult[0] ?? null;

if (!$groupe) {
    echo '<main class="container my-5"><div class="alert alert-danger">Groupe introuvable.</div></main>';
    include '../../../footer.php';
    exit;
}
?>

<main class="container my-5">
    <h1>Modifier un groupe</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="<?= ROOT_URL ?>/api/groupes/update.php" method="post">
        <input type="hidden" name="idGp" value="<?= (int) $groupe['idGp'] ?>">

        <div class="mb-3">
            <label for="nomGp" class="form-label">Nom du groupe</label>
            <input id="nomGp" name="nomGp" class="form-control" type="text" value="<?= htmlspecialchars($groupe['nomGp']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="dtCreaGp" class="form-label">Date de création</label>
            <input id="dtCreaGp" name="dtCreaGp" class="form-control" type="date" value="<?= htmlspecialchars($groupe['dtCreaGp']) ?>" required>
        </div>

        <a href="list.php" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</main>

<?php include '../../../footer.php'; ?>