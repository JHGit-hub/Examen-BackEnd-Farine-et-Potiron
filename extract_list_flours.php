<?php

/**
 * Contrôleur d'extraction de données
 *
 * Rôle:
 *      - extrait la liste des farines disponibles à partir de l'API
 *      - prépare le formulaire de création de recette
 *
 * Paramètres:
 *      - néant
 *
 * Retour:
 *      - $list_flours: tableau associatif contenant la liste des farines
 *      - $detail_flour: tableau associatif du détail de la farine issu de l'API
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


////// Affichage de la page
include "templates/pages/create_recipe.php";
