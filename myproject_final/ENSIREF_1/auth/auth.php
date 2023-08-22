<?php
// Vérifie si l'utilisateur existe dans la base de données
function userExists($email) {
    global $conn;
    $query = "SELECT * FROM utilisateurs WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Crée un nouvel utilisateur dans la base de données
function registerUser($username, $email, $password) {
    global $conn;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $role = "user";
    $query = "INSERT INTO utilisateurs (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);
    return $stmt->execute();
}

// Vérifie les informations d'identification de l'utilisateur lors de la connexion
function authenticateUser($email, $password) {
    global $conn;
    $query = "SELECT * FROM utilisateurs WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Utilisateur trouvé, vérifier le mot de passe
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
        if (password_verify($password, $hashedPassword)) {
            // Mot de passe correct, mettre à jour la variable de session et rediriger vers le dashboard
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $row['role'];

            // Rediriger vers le dashboard
            header('Location: dashboard.php');
            exit();
        } else {
            // Mot de passe incorrect
            $error = "Mot de passe incorrect";
        }
    } else {
        // Utilisateur non trouvé
        $error = "Nom d'utilisateur ou mot de passe incorrect";
    }

    return $error;
}
