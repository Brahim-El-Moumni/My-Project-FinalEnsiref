<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header('Location: /myproject_final/ENSIREF_1/auth/login.php');
    exit();
}

require_once '../auth/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare('DELETE FROM pc WHERE id = ?');
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        header('Location: admin_gestion.php');
        exit();
    } else {
        // Gérer l'erreur si la suppression échoue
        $error = 'Une erreur s\'est produite lors de la suppression du PC.';
    }
} else {
    // Rediriger si l'ID du PC n'est pas spécifié
    header('Location: admin_gestion.php');
    exit();
}
?>
