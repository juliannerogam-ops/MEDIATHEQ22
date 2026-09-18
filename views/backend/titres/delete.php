<?php
include '../../../header.php';

$idTit = (int) ($_GET['idTit'] ?? 0);
$titreResult = $idTit > 0 ? sql_select('TITRE', '*', 'idTit = ' . $idTit) : [];
$titre = $titreResult[0] ?? null;

if (!$titre) {
    echo '<main class="container my-5"><div class="alert alert-danger">Titre introuvable.</div></main>';
    include '../../../footer.php';
    exit;
}
?>

<main class="container my-5">
    <h1>Supprimer un titre</h1>
    <p><strong>Album :</strong> <?= (int) $titre['idAlb'] ?></p>
    <p><strong>Nom :</strong> <?= htmlspecialchars($titre['nomTit']) ?></p>
    <p><strong>Durée :</strong> <?= htmlspecialchars((string) $titre['dureeTit']) ?></p>

    <form action="<?= ROOT_URL ?>/api/titres/delete.php" method="post">
        <input type="hidden" name="idTit" value="<?= (int) $titre['idTit'] ?>">
        <a href="list.php" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
</main>

<?php include '../../../footer.php'; ?>