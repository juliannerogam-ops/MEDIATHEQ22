<?php
include '../../../header.php';

$idArt = (int) ($_GET['idArt'] ?? 0);
$artisteResult = $idArt > 0 ? sql_select('ARTISTE', '*', 'idArt = ' . $idArt) : [];
$artiste = $artisteResult[0] ?? null;

if (!$artiste) {
    echo '<main class="container my-5"><div class="alert alert-danger">Artiste introuvable.</div></main>';
    include '../../../footer.php';
    exit;
}
?>

<main class="container my-5">
    <h1>Supprimer un artiste</h1>
    <p><strong>Groupe :</strong> <?= (int) $artiste['idGp'] ?></p>
    <p><strong>Prénom :</strong> <?= htmlspecialchars($artiste['prenomArt']) ?></p>
    <p><strong>Nom :</strong> <?= htmlspecialchars($artiste['nomArt']) ?></p>

    <form action="<?= ROOT_URL ?>/api/artistes/delete.php" method="post">
        <input type="hidden" name="idArt" value="<?= (int) $artiste['idArt'] ?>">
        <a href="list.php" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
</main>

<?php include '../../../footer.php'; ?>