<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: /myproject_final/ENSIREF_1/auth/login.php');
    exit();
}

require_once '../auth/config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - ENSIREF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .status-pill {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .status-available {
            background-color: green;
        }

        .status-repair {
            background-color: red;
        }

        .status-rented {
            background-color: orange;
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

    <div class="container mt-4">
        <div class="row">
            <h2>Materiel disponible :</h2>
            <div class="row">
                <?php
                $stmt = $conn->prepare('SELECT * FROM pc');
                $stmt->execute();
                $result = $stmt->get_result();
                while ($pc = $result->fetch_assoc()):
                    $statusClass = '';
                    $statusText = '';
                    $buttonDisabled = '';

                    if ($pc['status'] === 'Disponible') {
                        $statusClass = 'status-available';
                        $statusText = 'Disponible';
                    } elseif ($pc['status'] === 'Maintenance') {
                        $statusClass = 'status-repair';
                        $statusText = 'En réparation';
                        $buttonDisabled = 'disabled';
                    } elseif ($pc['status'] === 'Réservé') {
                        $statusClass = 'status-rented';
                        $statusText = 'Loué';
                        $buttonDisabled = 'disabled';
                    }
                ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                        <img src="<?php echo $pc['image']; ?>" class="card-img-top" alt="<?php echo $pc['description']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $pc['description']; ?></h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">RAM: <?php echo $pc['ram']; ?></li>
                                    <li class="list-group-item">Processeur: <?php echo $pc['processeur']; ?></li>
                                    <li class="list-group-item">Stockage: <?php echo $pc['stockage']; ?></li>
                                </ul>
                                <div>
                                    <span class="status-pill <?php echo $statusClass; ?>"></span>
                                    <?php echo $statusText; ?>
                                </div>
                                <?php if ($pc['status'] === 'Disponible'): ?>
                                    <a href="reservation.php?pc_id=<?php echo $pc['id']; ?>" class="btn btn-primary">Réserver</a>
                                <?php else: ?>
                                    <button class="btn btn-primary" disabled>Réserver</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php
