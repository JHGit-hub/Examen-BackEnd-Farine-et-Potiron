<?php

/**
 * Contrôleur AJAX
 *
 * Rôle:
 *      - Enregistre les modifications du profil utilisateur
 *
 * Paramètre:
 *      - (via $_POST)password: mot de passe du profil
 *      - (via $_POST)username: pseudo du profil
 *      - (via $_POST)email: nouvel email du profil
 *
 * Retourne:
 *      - fragment HTML généré par frag_edit_profil.php
 */

////// Initialisation:
include_once "library/init.php";

////// Contrôle de session utilisateur:
if (!$session->isLogged()) {
    // L'utilisateur N'EST PAS connecté
    header('Location: index.php');
    exit();
}

////// Traitement:
// On instancie et charge la classe User
$user = new User($session->idConnected());

// On charge les données du formulaire
// Chargement des champs textes du formulaire
$user->loadFromTab($_POST);

// Mise à jour du mot de passe uniquement s'il a été modifié
if (!empty($_POST["password"])) {
    $password_hashed = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $user->set("password", $password_hashed);
}

// On met à jour le profil utilisateur
$user->update();

////// Affichage de la page:
include "templates/fragments/header/frag_edit_profil.php";
