<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: /myproject_final/ENSIREF_1/auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Réservation réussie - ENSIREF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 100px;
            text-align: center;
        }
        h1 {
            font-size: 36px;
            font-weight: bold;
        }
        p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="http://localhost/myproject_final/ENSIREF_1/application/dashboard.php">ENSIREF</a>
        <span class="navbar-text text-center text-warning mx-auto">
            Bienvenue, <?php echo $_SESSION['email']; ?>
        </span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link text-success" href="../admin/admin_gestion.php">Gestion du matériel</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Déconnexion</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Réservation réussie</h1>
        <p>Votre réservation a été enregistrée avec succès.</p>
        <a href="dashboard.php" class="btn btn-primary">Retour au tableau de bord</a>
    </div>
</body>
</html>
