<?php
// Fichier de connexion pour la base de données 

$host = "localhost"; // Serveur MySQL
$dbname = "maintenance_applicative"; // Nom de la base de données
$username = "root"; // Nom d'utilisateur MySQL
$password = "root"; // Nom d'utilisateur MySQL


// Vérification des champs pour voir si on peut accéder a la bdd 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>