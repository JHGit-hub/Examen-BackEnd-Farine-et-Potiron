<?php

/**
 * Contrôleur d'enregistrement de donnée
 *
 * Rôle:
 *      - Enregistre un nouvel utilisateur dans la base de données
 *
 * Paramètres:
 *      - (via $_POST) email: adresse email de l'utilisateur
 *      - (via $_POST) password: mot de passe de l'utilisateur
 *      - (via $_POST) username: pseudo de l'utilisateur
 *
 * Retour:
 *      - néant
 */

////// Initialisation:
include_once "library/init.php";

////// Traitement:
// On instancie la classe User
$user = new User();

// On récupére les données du formulaire
$new_user = $user->loadFromTab($_POST);

// On enregistre l'utilisateur dans la base de données
$user->insert();

// On déclare que le nouvel utilisateur est connecté
$user = $session->logged($user->id());

////// Affichage de la page:
include "index.php";