<?php

/**
 * ============================================================
 *  Contrôleur d'enregistrement de donnée : save_new_user.php
 *  Rôle :
 *      - Enregistre un nouvel utilisateur dans la base de données
 *
 *  Paramètres attendus :
 *      - (via $_POST) email : adresse email de l'utilisateur
 *      - (via $_POST) password : mot de passe de l'utilisateur
 *      - (via $_POST) username : pseudo de l'utilisateur
 *
 *  Retour :
 *      - néant (redirection ou affichage page accueil)
 * ============================================================
 */

////// Initialisation:
include_once "library/init.php";

// Verification anti-bot
if (!empty($_POST['website'])) {
    // Si le champ 'website' est rempli, on empêche l'accés au bot
    echo "Accès refusé"; // On affiche un message
    header('Refresh: 2; URL=index.php'); // Redirige après 2 secondes (avec refresh)
    exit();
}

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