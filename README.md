# Projet de Maintenance Applicative

## Réaliser par DUPUIS Brian et MAZURIER Eve
## Description

Ce projet a été réalisé dans le but de créer un site simple permettant aux utilisateurs de se connecter à l'aide de leurs identifiants. L'objectif principal de ce projet était d'identifier et de résoudre deux problèmes spécifiques :

1. **Un défaut de mise en page** : Le bouton de connexion était décalé.
2. **Une faille de sécurité** : dans le système de connexion de l'utilisateur. La faille a été corrigée en changeant la manière de connexion pour vérifier à la fois l'email et le mot de passe de l'utilisateur.

### Date de réalisation :
- **Date** : 25 février 2025

## Fonctionnalités

Le projet comporte les éléments suivants :
- Une page de connexion permettant d'entrer un identifiant et un mot de passe.
- Un bouton de connexion qui, lorsqu'il est cliqué, permet de se connecter au système.
- Une page simple après connexion (accueil).

## Technologies utilisées

- **HTML/CSS** : Pour la création de la page et de la mise en page.
- **MySQL** : Pour gérer la base de données.

## Outils utilisé :

- **Laragon** 

## Instructions pour exécuter le projet

1. Clonez ce repository sur votre machine locale :
   ```bash
   git clone https://github.com/mazuriereve/maintenance_applicative.git
   ```

2. Une fois le fichier créé, allez dans votre base de données sur votre serveur local et vérifiez le fichier connexion.php et modifiez les logins si nécessaires.

3. Démarrez le projet et inscrivez-vous dans un premier temps.

4. Dans votre base de données, entrez ce code afin de créer votre base de données et votre table users :
   ```sql
   CREATE DATABASE maintenance_applicative;

   USE maintenance_applicative;

   CREATE TABLE users (
       id_user INT AUTO_INCREMENT PRIMARY KEY,
       email_user VARCHAR(255) NOT NULL UNIQUE,
       mdp VARCHAR(255) NOT NULL,
       nom_user VARCHAR(255) NOT NULL
   );
   ```
