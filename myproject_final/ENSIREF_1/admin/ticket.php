<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: /myproject_final/ENSIREF_1/auth/login.php'); // Modifier le chemin selon votre projet
    exit();
}

require_once '../auth/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les informations de la réservation depuis le formulaire
    $user_id = $_SESSION['user_id'];
    $pc_id = $_POST['pc_id'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $start_datetime = $date . ' ' . $heure;
    
    // Insérer la demande de réservation dans la base de données (table tickets)
    $stmt = $conn->prepare('INSERT INTO tickets (user_id, pc_id, start_datetime) VALUES (?, ?, ?)');
    $stmt->bind_param('iis', $user_id, $pc_id, $start_datetime);
    if ($stmt->execute()) {
        $success_message = "Votre demande de réservation a été soumise avec succès.";
    } else {
        $error_message = "Une erreur est survenue lors de la soumission de votre demande.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Demande de Réservation - ENSIREF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">ENSIREF</a>
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

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Demande de Réservation</h2>
                <?php if (isset($success_message)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <form method="POST">
                    <input type="hidden" name="pc_id" value="<?php echo $_GET['pc_id']; ?>">
                    <div class="form-group">
                        <label for="date">Date de Réservation</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="heure">Heure de Réservation</label>
                        <input type="time" class="form-control" name="heure" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Soumettre la Demande</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
