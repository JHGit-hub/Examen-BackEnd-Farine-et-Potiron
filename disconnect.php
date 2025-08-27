<?php

/**
 * ============================================================
 *  Contrôleur : disconnect.php
 *  Rôle :
 *      - Déconnecte l'utilisateur de la session.
 *
 *  Paramètres :
 *      - néant
 *
 *  Retour :
 *      - néant (redirection vers la page d'accueil)
 * ============================================================
 */

////// Initialisation:
include_once "library/init.php";

////// Traitement:
// Suppression de la session utilisateur
$session->logOut();

////// Redirection vers la page d'accueil:
header('location: index.php');
exit;