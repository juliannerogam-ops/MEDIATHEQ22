<?php
include '../../../header.php';

$error = '';

// Traitement login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');

    // Récupération du membre
    $emailForQuery = str_replace("'", "''", $email);
    $user = sql_select("USER", "*", "eMailUser = '$emailForQuery'");

    if (empty($user)) {
        $error = "Email incorrect.";
    } else {
        $user = $user[0];

        if (
            strcasecmp((string) $user['eMailUser'], $email) !== 0
            || strcasecmp((string) $user['nomEUser'], $nom) !== 0
            || strcasecmp((string) $user['prenomUser'], $prenom) !== 0
        ) {
            $error = "Le nom ou le prénom ne correspond pas à cette adresse email.";
        } else {
            $_SESSION['user'] = [
                'email'  => $user['eMailUser'],
                'nom'    => $user['nomEUser'],
                'prenom' => $user['prenomUser']
            ];

            header('Location: /index.php');
            exit;
        }
    }
}
?>

<div class="container mt-5">
    <h2>Connexion</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
        <input class="form-control mb-2" name="email" type="email" placeholder="Email" required>
        <input class="form-control mb-2" name="nom" placeholder="Nom" required>
        <input class="form-control mb-2" name="prenom" placeholder="Prénom" required>

        <button class="btn btn-primary mt-2">Connexion</button>
        <a href="signup.php" class="btn btn-secondary mt-2">Créer un compte</a>
    </form>
</div>



