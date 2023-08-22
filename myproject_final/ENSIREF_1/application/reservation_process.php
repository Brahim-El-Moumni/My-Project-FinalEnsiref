<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: /myproject_finals/ENSIREF_1/auth/login.php');
    exit();
}

require_once '../auth/config.php';

// Vérifier si toutes les données sont présentes
if (!isset($_POST['pc_id'], $_POST['date'], $_POST['heure'])) {
    header('Location: dashboard.php');
    exit();
}

$pc_id = $_POST['pc_id'];
$date = $_POST['date'];
$heure = $_POST['heure'];
$user_id = $_SESSION['user_id'];

// Insérer la réservation dans la base de données
$stmt = $conn->prepare('INSERT INTO reservation (pc_id, date, heure, user_id) VALUES (?, ?, ?, ?)');
$stmt->bind_param('isss', $pc_id, $date, $heure, $user_id);

if ($stmt->execute()) {
    $reservation_id = $stmt->insert_id;
    $stmt->close();

    // Rediriger vers une page de succès avec l'ID de réservation
    header('Location: reservation_success.php?id=' . $reservation_id);
    exit();
} else {
    $stmt->close();

    // Rediriger vers une page d'erreur
    header('Location: reservation_error.php');
    exit();
}



