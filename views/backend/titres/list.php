<?php
include '../../../header.php';

$titres = sql_select(
    'TITRE t INNER JOIN ALBUM a ON t.idAlb = a.idAlb',
    't.idTit, t.idAlb, t.nomTit, t.dureeTit, a.nomA'
);
?>

<main class="container my-5">
    <h1> Titres</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <table class="table table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th>Id</th>
                <th>Album</th>
                <th>Nom du titre</th>
                <th>Durée</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($titres as $titre): ?>
                <tr>
                    <td><?= (int) $titre['idTit'] ?></td>
                    <td><?= htmlspecialchars($titre['nomA'] ?? 'Album #' . $titre['idAlb']) ?></td>
                    <td><?= htmlspecialchars($titre['nomTit']) ?></td>
                    <td><?= htmlspecialchars((string) $titre['dureeTit']) ?></td>
                    <td>
                        <a href="edit.php?idTit=<?= (int) $titre['idTit'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="delete.php?idTit=<?= (int) $titre['idTit'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="create.php" class="btn btn-success">Créer un titre</a>
</main>

<?php include '../../../footer.php'; ?>