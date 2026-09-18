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
    <h1>Supprimer un groupe</h1>
    <p><strong>Nom :</strong> <?= htmlspecialchars($groupe['nomGp']) ?></p>
    <p><strong>Date de création :</strong> <?= htmlspecialchars($groupe['dtCreaGp']) ?></p>

    <form action="<?= ROOT_URL ?>/api/groupes/delete.php" method="post">
        <input type="hidden" name="idGp" value="<?= (int) $groupe['idGp'] ?>">
        <a href="list.php" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
</main>

<?php include '../../../footer.php'; ?>