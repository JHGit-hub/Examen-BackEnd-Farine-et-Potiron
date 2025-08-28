<?php

/**
 * ============================================================
 *  Contrôleur : extract_list_flours.php
 *  Rôle :
 *      - Extrait la liste des farines disponibles à partir de l'API
 *      - Prépare le formulaire de création de recette
 *
 *  Paramètres :
 *      - néant
 *
 *  Retour :
 *      - $list_flours : tableau associatif contenant la liste des farines
 *      - $user : objet de l'utilisateur connecté
 * ============================================================
 */

////// Initialisation:
include_once "library/init.php";

////// Contrôle de session utilisateur:
if (!$session->isLogged()) {
    // L'utilisateur N'EST PAS connecté
    header('Location: index.php');
    exit();
}

////// Traitement

// On récupére le catalogue des farines
$list_flours = Flour::getFlourCatalogue();

// On charge l'utilisateur connecté si la session est active, vide sinon
$user = User::getCurrentUser();

////// Affichage de la page
include "templates/pages/create_recipe.php";
