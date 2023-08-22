<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Inclure la configuration de la base de données et les fonctions d'authentification
    require_once 'config.php';
    require_once 'auth.php';

    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier si l'utilisateur existe déjà dans la base de données
    if (userExists($email)) {
        echo 'Cet utilisateur existe déjà.';
        exit();
    }

    // Créer le compte utilisateur
    $result = registerUser($username, $email, $password);

    if ($result) {
        // Rediriger vers la page de connexion avec un message de succès
        header('Location: login.php?register=success');
        exit();
    } else {
        echo 'Une erreur s\'est produite lors de l\'enregistrement de l\'utilisateur.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription - ENSIREF</title>
    <!-- Inclure les liens vers les fichiers CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Inscription</h1>
        <form method="POST">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>

    <!-- Inclure les scripts JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
