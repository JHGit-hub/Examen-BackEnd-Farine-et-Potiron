<?php

/**
 * Contrôleur de connexion utilisateur
 *
 * Rôle:
 *      - vérifie les identifiants de l'utilisateur
 *
 * Paramètres:
 *      - (via $_POST)username: nom d'utilisateur
 *      ou au choix de l'utilisateur
 *      - (via $_POST)email: adresse e-mail 
 *      - (via $_POST)password: mot de passe
 *
 * Retour:
 *      - true si valide, false sinon
 */

////// Initialisation:
include_once "library/init.php";

// Récupération des paramètres:
// On verife si le formulaire est bien rempli
if (empty($_POST["email"]) || empty($_POST["password"])) {
    $_SESSION['error_msg'] = "Merci de remplir tous les champs."; //affichage d'un message d'erreur
    header('location: index.php'); // renvoi vers la page du formulaire
    exit; // arrete le script si form invalide
}

$email = $_POST["email"];
$password = $_POST["password"];

// Verification de la connexion
$user = User::validateLogin($email, $password);

if (!$user) { // connexion refusé, retour au formulaire
    $_SESSION['error_msg'] = "Adresse email ou mot de passe incorrect."; //affichage d'un message d'erreur
    header('location: index.php'); // renvoi vers la page du formulaire
    exit;
}

// connexion réussi, on le log à la session
$_SESSION['sucess_msg'] = "Connexion réussie.";
$session->logged($user->id());
header('location: index.php');
exit;
