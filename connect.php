<?php

/**
 * ============================================================
 *  Contrôleur : connect.php
 *  Rôle :
 *      - Vérifie les identifiants de l'utilisateur et connecte l'utilisateur si les informations sont valides.
 *
 *  Paramètres attendus :
 *      - (via $_POST) username : nom d'utilisateur OU
 *      - (via $_POST) email : adresse e-mail selon le choix de l'utilisateur
 *      - (via $_POST) password : mot de passe
 *
 *  Retour :
 *      - true si valide, false sinon
 * ============================================================
 */

////// Initialisation:
include_once "library/init.php";

//// Récupération des paramètres:
// On vérifie si le formulaire est bien rempli
if (empty($_POST["login_input"]) || empty($_POST["password"])) {
    $_SESSION['error_msg'] = "Merci de remplir tous les champs."; //affichage d'un message d'erreur
    header('location: index.php'); // renvoi vers la page du formulaire
    exit; // arrête le script si formulaire invalide
}

// On récupére le mot de passe
$password = $_POST["password"];

// On récupére le mode de connexion et la valeur du champ de l'input
$login_mode_name = $_POST["login_mode"];
$login_mode_value = $_POST["login_input"];


// Verification de la connexion
$user = User::validateLogin($password, $login_mode_name, $login_mode_value);

if (!$user) { // connexion refusée, retour au formulaire
    $_SESSION['error_msg'] = "Adresse email ou mot de passe incorrect."; //affichage d'un message d'erreur
    header('location: index.php'); // renvoi vers la page du formulaire
    exit;
}

// connexion réussi, on le log à la session
$session->logged($user->id());
header('location: index.php');
exit;
