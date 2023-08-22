<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header('Location: /myproject_final/ENSIREF_1/auth/login.php');
    exit();
}

require_once '../auth/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $ram = $_POST['ram'];
    $processeur = $_POST['processeur'];
    $stockage = $_POST['stockage'];

    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $imagePath = '/myproject_final/ENSIREF_1/img/' . $image['name'];

        // Déplacer le fichier téléchargé vers le répertoire souhaité
        move_uploaded_file($image['tmp_name'], $imagePath);
    } else {
        // Gérer le cas où aucune image n'a été sélectionnée
        $imagePath = '';
    }

    $stmt = $conn->prepare('INSERT INTO pc (description, ram, processeur, stockage, image, status) VALUES (?, ?, ?, ?, ?, ?)');
    $status = 'Disponible';
    $stmt->bind_param('sissss', $description, $ram, $processeur, $stockage, $imagePath, $status);

    if ($stmt->execute()) {
        header('Location: admin_gestion.php');
        exit();
    } else {
        $error = 'Une erreur s\'est produite lors de l\'ajout du PC.';
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
        <h2>Ajouter un PC</h2>
        <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="form-group">
                <label for="ram">RAM</label>
                <input type="number" class="form-control" id="ram" name="ram" required>
            </div>
            <div class="form-group">
                <label for="processeur">Processeur</label>
                <input type="text" class="form-control" id="processeur" name="processeur" required>
            </div>
            <div class="form-group">
                <label for="stockage">Stockage</label>
                <input type="text" class="form-control" id="stockage" name="stockage" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        <h2>Liste des PCs</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Description</th>
                    <th>RAM</th>
                    <th>Processeur</th>
                    <th>Stockage</th>
                    <th>État</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare('SELECT * FROM pc');
                $stmt->execute();
                $result = $stmt->get_result();
                while ($pc = $result->fetch_assoc()):
                ?>
                    <tr>
                        <td><img src="<?php echo $pc['image']; ?>" alt="<?php echo $pc['description']; ?>" width="100"></td>
                        <td><?php echo $pc['description']; ?></td>
                        <td><?php echo $pc['ram']; ?></td>
                        <td><?php echo $pc['processeur']; ?></td>
                        <td><?php echo $pc['stockage']; ?></td>
                        <td>
                            <?php
                            $status = $pc['status'];
                            $badgeClass = '';

                            switch ($status) {
                                case 'Disponible':
                                    $badgeClass = 'badge badge-success';
                                    break;
                                case 'En réparation':
                                    $badgeClass = 'badge badge-danger';
                                    break;
                                case 'Loué':
                                    $badgeClass = 'badge badge-warning';
                                    break;
                                default:
                                    $badgeClass = 'badge badge-secondary';
                            }
                            ?>
                            <span class="<?php echo $badgeClass; ?>"><?php echo $status; ?></span>
                        </td>
                        <td>
                            <a href="edit_pc.php?id=<?php echo $pc['id']; ?>" class="btn btn-primary">Modifier</a>
                            <a href="delete_pc.php?id=<?php echo $pc['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce PC ?')">Supprimer</a>
                        </td>
                        </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

