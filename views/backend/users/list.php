<?php
include '../../../header.php';

$users = sql_select("USER", "nomEUser, prenomUser, eMailUser");
?>

<main class="container my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Users</h1>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['prenomUser']); ?></td>
                                <td><?php echo htmlspecialchars($user['nomEUser']); ?></td>
                                <td><?php echo htmlspecialchars($user['eMailUser']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <a href="create.php" class="btn btn-success">Create</a>
            </div>
        </div>
    </div>
</main>

<?php include '../../../footer.php'; ?>
