<?php
session_start(); // Démarre la session pour stocker des variables de session
include 'connexion.php'; // Inclusion du fichier de connexion à la base de données

$message = ""; // Variable pour stocker les messages d'erreur ou de succès

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mdp = trim($_POST['mdp']); // Récupère et nettoie le mot de passe entré

    // Vérifie si le champ mot de passe est vide
    if (empty($mdp)) {
        $message = "<p class='error'>Veuillez remplir tous les champs.</p>";
    } else {
        // Récupère le premier utilisateur trouvé dans la base de données
        $stmt = $pdo->query("SELECT * FROM users LIMIT 1");
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère le résultat sous forme de tableau associatif

        // Vérifie si un utilisateur a été trouvé et si le mot de passe correspond
        if ($user && password_verify($mdp, $user['mdp'])) {
            $_SESSION['connected'] = true; // Définit la session comme "connecté"
            $_SESSION['nom_user'] = $user['nom_user']; // Stocke le nom de l'utilisateur connecté
            header("Location: index.php"); // Redirige vers la page d'accueil
            exit(); // Stoppe l'exécution du script après la redirection
        } else {
            $message = "<p class='error'>Mot de passe incorrect.</p>";
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
            <input type="email" name="email_user" placeholder="Email"> <!-- Champ email -->
            <input type="password" name="mdp" placeholder="Mot de passe" required> <!-- Champ mot de passe -->
            <button type="submit">Se connecter</button> <!-- Bouton de connexion -->
        </form>
        <p><a href="page_inscription.php">Créer un compte</a></p> <!-- Lien vers la page d'inscription -->
    </div>
</body>
</html>
