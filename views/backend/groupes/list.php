<?php
include '../../../header.php';

$groupes = sql_select('GROUPE', 'idGp, nomGp, dtCreaGp', '', '', 'nomGp ASC');
?>

<main class="container my-5">
    <h1>Groupes</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <table class="table table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom du groupe</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groupes as $groupe): ?>
                <tr>
                    <td><?= (int) $groupe['idGp'] ?></td>
                    <td><?= htmlspecialchars($groupe['nomGp']) ?></td>
                    <td><?= htmlspecialchars($groupe['dtCreaGp']) ?></td>
                    <td>
                        <a href="edit.php?idGp=<?= (int) $groupe['idGp'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="delete.php?idGp=<?= (int) $groupe['idGp'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="create.php" class="btn btn-success">Créer un groupe</a>
</main>

<?php include '../../../footer.php'; ?>