<?php
include 'connexion.php'; // Inclusion du fichier de connexion à la base de données

$message = ""; // Variable pour stocker les messages d'erreur ou de succès

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_user = trim($_POST['nom_user']); // Récupère et nettoie le nom d'utilisateur
    $email_user = trim($_POST['email_user']); // Récupère et nettoie l'email
    $mdp = trim($_POST['mdp']); // Récupère et nettoie le mot de passe

    // Vérifie que tous les champs sont remplis
    if (empty($nom_user) || empty($email_user) || empty($mdp)) {
        $message = "<p class='error'>Tous les champs sont obligatoires.</p>";
    } 
    // Vérifie si l'email est valide
    elseif (!filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
        $message = "<p class='error'>Email invalide.</p>";
    } 
    else {
        // Vérifie si l'email est déjà utilisé
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email_user = ?");
        $stmt->execute([$email_user]);

        if ($stmt->rowCount() > 0) { // Si un utilisateur avec cet email existe déjà
            $message = "<p class='error'>Cet email est déjà utilisé.</p>";
        } 
        else {
            // Hachage du mot de passe pour plus de sécurité
            $mdp_hash = password_hash($mdp, PASSWORD_BCRYPT);

            // Insertion des données dans la base
            $stmt = $pdo->prepare("INSERT INTO users (nom_user, email_user, mdp) VALUES (?, ?, ?)");
            if ($stmt->execute([$nom_user, $email_user, $mdp_hash])) {
                $message = "<p class='success'>Inscription réussie !</p>"; // Message de succès
            } 
            else {
                $message = "<p class='error'>Erreur lors de l'inscription.</p>"; // Message d'erreur si l'insertion échoue
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers la feuille de style CSS -->
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>
        <?= $message; ?> <!-- Affiche le message d'erreur ou de succès -->
        <form action="" method="POST">
            <input type="text" name="nom_user" placeholder="Nom d'utilisateur" required> <!-- Champ nom d'utilisateur -->
            <input type="email" name="email_user" placeholder="Email" required> <!-- Champ email -->
            <input type="password" name="mdp" placeholder="Mot de passe" required> <!-- Champ mot de passe -->
            <button type="submit">S'inscrire</button> <!-- Bouton d'inscription -->
        </form>
    </div>
</body>
</html>
