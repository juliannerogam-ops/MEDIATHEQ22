<?php
include '../../../header.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom  = $_POST['prenomUser'] ?? '';
    $nom     = $_POST['nomUser'] ?? '';
    $email   = $_POST['eMailUser'] ?? '';


        $exist = sql_select("user", "*", "eMailUser = '$email'");

        if (!empty($exist)) {
            $error = "Un compte avec cet email existe déjà.";
        } else {
            
            sql_insert(
                "user",
                "eMailUser, nomEUser, prenomUser",
                "'$email', '$nom', '$prenom'"
            );

            $success = "Compte créé avec succès. Vous pouvez vous connecter.";
        }
    }

?>

<div class="container mt-5">
    <h2>Inscription</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="post">
        <input class="form-control mb-2" name="email" type="email" placeholder="Email" required>
        <input class="form-control mb-2" name="nom" placeholder="Nom" required>
        <input class="form-control mb-2" name="prenom" placeholder="Prénom" required>

        <button class="btn btn-success mt-2">Créer le compte</button>
        <a href="login.php" class="btn btn-primary mt-2">Connexion</a>
    </form>
</div>


