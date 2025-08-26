<?php

/**
 * Contrôleur de déconnexion utilisateur
 *
 * Rôle:
 *      - déconnecte l'utilisateur de la session
 *
 * Paramètres:
 *      - néant
 *
 * Retour:
 *      - néant
 */

////// Initialisation:
include_once "library/init.php";

////// Traitement:
// Suppression de la session utilisateur
$session->logOut();

////// Redirection vers la page d'accueil:
header('location: index.php');
exit;