<?php
session_start(); // Démarre la session pour stocker des variables de session
include 'connexion.php'; // Inclusion du fichier de connexion à la base de données

$message = ""; // Variable pour stocker les messages d'erreur ou de succès


//Corrige la faille qui permettait de se connecter juste avec le bon mot de passe et un mauvais email

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_user = trim($_POST['email_user']); // Récupère et nettoie l'email entré
    $mdp = trim($_POST['mdp']); // Récupère et nettoie le mot de passe entré

    // Vérifie si les champs email et mot de passe sont vides
    if (empty($email_user) || empty($mdp)) {
        $message = "<p class='error'>Veuillez remplir tous les champs.</p>";
    } else {
        // Prépare une requête pour récupérer l'utilisateur avec l'email fourni
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email_user = ?");
        $stmt->execute([$email_user]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère le résultat sous forme de tableau associatif

        // Vérifie si un utilisateur a été trouvé et si le mot de passe correspond
        if ($user && password_verify($mdp, $user['mdp'])) {
            $_SESSION['connected'] = true; // Définit la session comme "connecté"
            $_SESSION['nom_user'] = $user['nom_user']; // Stocke le nom de l'utilisateur connecté
            header("Location: index.php"); // Redirige vers la page d'accueil
            exit(); // Stoppe l'exécution du script après la redirection
        } else {
            $message = "<p class='error'>Email ou mot de passe incorrect.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers la feuille de style CSS -->
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <?= $message; ?> <!-- Affichage du message d'erreur ou de succès -->
        <form action="" method="POST">
            <input type="email" name="email_user" placeholder="Email" required> <!-- Champ email -->
            <input type="password" name="mdp" placeholder="Mot de passe" required> <!-- Champ mot de passe -->
            <button type="submit">Se connecter</button> <!-- Bouton de connexion -->
        </form>
        <p><a href="page_inscription.php">Créer un compte</a></p> <!-- Lien vers la page d'inscription -->
    </div>
</body>
</html>
