<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header('Location: /myproject_final/ENSIREF_1/auth/login.php');
    exit();
}

require_once '../auth/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare('SELECT * FROM pc WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pc = $result->fetch_assoc();

    if (!$pc) {
        // Rediriger si le PC n'est pas trouvé
        header('Location: admin_gestion.php');
        exit();
    }
} else {
    // Rediriger si l'ID du PC n'est pas spécifié
    header('Location: admin_gestion.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $ram = $_POST['ram'];
    $processeur = $_POST['processeur'];
    $stockage = $_POST['stockage'];
    $status = $_POST['status'];

    $stmt = $conn->prepare('UPDATE pc SET description = ?, ram = ?, processeur = ?, stockage = ?, status = ? WHERE id = ?');
    $stmt->bind_param('sisssi', $description, $ram, $processeur, $stockage, $status, $id);

    if ($stmt->execute()) {
        header('Location: admin_gestion.php');
        exit();
    } else {
        $error = 'Une erreur s\'est produite lors de la modification du PC.';
    }
}
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion du matériel - ENSIREF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="http://localhost/myproject_final/ENSIREF_1/application/dashboard.php">ENSIREF</a>
        <span class="navbar-text text-center text-warning mx-auto">
        <?php echo $_SESSION['email']; ?>
        </span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                        <a class="nav-link text-success" href="../application/dashboard.php">PC's disponibles</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="../auth/logout.php">Déconnexion</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Gestion du matériel</h1>
        <?php if ($error !== ''): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <h2>Modifier le PC</h2>
        <form method="POST">
            <div class="form-group">
            <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo $pc['description']; ?>" required>
            </div>
            <div class="form-group">
                <label for="ram">RAM</label>
                <input type="number" class="form-control" id="ram" name="ram" value="<?php echo $pc['ram']; ?>" required>
            </div>
            <div class="form-group">
                <label for="processeur">Processeur</label>
                <input type="text" class="form-control" id="processeur" name="processeur" value="<?php echo $pc['processeur']; ?>" required>
            </div>
            <div class="form-group">
                <label for="stockage">Stockage</label>
                <input type="text" class="form-control" id="stockage" name="stockage" value="<?php echo $pc['stockage']; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Disponible" <?php if ($pc['status'] === 'Disponible') echo 'selected'; ?>>Disponible</option>
                    <option value="Réservé" <?php if ($pc['status'] === 'Réservé') echo 'selected'; ?>>Réservé</option>
                    <option value="Maintenance" <?php if ($pc['status'] === 'Maintenance') echo 'selected'; ?>>Maintenance</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
