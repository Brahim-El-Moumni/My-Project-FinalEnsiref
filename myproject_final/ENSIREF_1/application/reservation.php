<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: /myproject_final/ENSIREF_1/auth/login.php');
    exit();
}

require_once '../auth/config.php';

// Vérifier si un PC est sélectionné
if (!isset($_GET['pc_id'])) {
    header('Location: dashboard.php');
    exit();
}

$pc_id = $_GET['pc_id'];

// Récupérer les informations du PC sélectionné
$stmt = $conn->prepare('SELECT * FROM pc WHERE id = ?');
$stmt->bind_param('i', $pc_id);
$stmt->execute();
$result = $stmt->get_result();
$pc = $result->fetch_assoc();

// Vérifier si le PC existe
if (!$pc) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Réservation de PC - ENSIREF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .card {
            width: 400px;
            margin: 0 auto;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .card-title {
            margin-top: 10px;
            font-size: 24px;
            font-weight: bold;
        }
        .list-group-item {
            font-size: 16px;
        }
        .booking-form {
            margin-top: 50px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-submit {
            margin-top: 20px;
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
    <div class="row">
        <?php if ($pc): ?>
            <div class="col-md-6">
                <div class="card mb-4">
                    <img src="<?php echo $pc['image']; ?>" class="card-img-top" alt="<?php echo $pc['description']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $pc['description']; ?></h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">RAM: <?php echo $pc['ram']; ?></li>
                            <li class="list-group-item">Processeur: <?php echo $pc['processeur']; ?></li>
                            <li class="list-group-item">Stockage: <?php echo $pc['stockage']; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h2>Réservation de PC</h2>
                <form class="booking-form" method="POST" action="reservation_process.php">
                    <input type="hidden" name="pc_id" value="<?php echo $pc_id; ?>">
                    <div class="form-group">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Créneau horaire</label>
                        <select name="heure" class="form-control" required>
                            <option value="8:00">8:00</option>
                            <option value="9:00">9:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-submit">Réserver</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
