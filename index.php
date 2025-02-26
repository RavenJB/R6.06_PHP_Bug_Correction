<?php
session_start(); // Démarre la session pour gérer l'authentification

// Vérifie si l'utilisateur est connecté
$isConnected = isset($_SESSION['connected']) && $_SESSION['connected']; 

// Récupère le nom de l'utilisateur s'il est connecté, sinon laisse vide
$nom_user = isset($_SESSION['nom_user']) ? $_SESSION['nom_user'] : ''; 

// Gestion de la déconnexion
if (isset($_GET['logout'])) { 
    session_destroy(); // Détruit la session pour déconnecter l'utilisateur
    header('Location: index.php'); // Redirige vers la page d'accueil
    exit(); // Arrête l'exécution du script après la redirection
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="style.css"> <!-- Inclusion du fichier CSS -->
</head>
<body>
    <div class="container_main">
        <div class="header">
            <?php if ($isConnected): ?> <!-- Vérifie si l'utilisateur est connecté -->
                <a href="?logout=1" class="button_login">Se déconnecter</a> <!-- Bouton de déconnexion -->
                <span class="status">Bonjour, <?= htmlspecialchars($nom_user); ?> ! 👋</span> <!-- Affiche le nom de l'utilisateur -->
            <?php else: ?> <!-- Si l'utilisateur n'est pas connecté -->
                <a href="login.php" class="button_login">Se connecter</a> <!-- Lien vers la page de connexion -->
                <span class="status">Non connecté</span> <!-- Message indiquant l'état de connexion -->
            <?php endif; ?>
        </div>
        <div class="content">
            <br><br>
            <h1>Bienvenue sur la page d'accueil !</h1> <!-- Titre principal -->
            <p>Ceci est une page basique avec un bouton de connexion.</p> <!-- Texte de bienvenue -->
        </div>
    </div>
</body>
</html>
