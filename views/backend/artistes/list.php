<?php
include '../../../header.php';

$artistes = sql_select(
    'ARTISTE ar LEFT JOIN GROUPE g ON ar.idGp = g.idGp',
    'ar.idArt, ar.idGp, ar.nomArt, ar.prenomArt, g.nomGp',
    '',
    '',
    'ar.nomArt ASC, ar.prenomArt ASC'
);
?>

<main class="container my-5">
    <h1>Artistes</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <table class="table table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th>Id</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Groupe</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($artistes as $artiste): ?>
                <tr>
                    <td><?= (int) $artiste['idArt'] ?></td>
                    <td><?= htmlspecialchars($artiste['prenomArt']) ?></td>
                    <td><?= htmlspecialchars($artiste['nomArt']) ?></td>
                    <td><?= htmlspecialchars($artiste['nomGp'] ?? 'Groupe #' . $artiste['idGp']) ?></td>
                    <td>
                        <a href="edit.php?idArt=<?= (int) $artiste['idArt'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="delete.php?idArt=<?= (int) $artiste['idArt'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="create.php" class="btn btn-success">Créer un artiste</a>
</main>

<?php include '../../../footer.php'; ?>