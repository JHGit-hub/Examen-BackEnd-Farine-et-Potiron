<?php

/**
 * Contrôleur principal
 *
 * Rôle:
 *      - prépare l'affichage de la page homepage
 *
 * Paramètres:
 *      - néant
 *
 * Retour:
 *      - $list_recipes: tableaux d'objets contenant les recettes incluant leurs titres, leurs id, leurs niveaux de difficultés et les références de farine utilisées
 *      - $list_flours: tableau associatif contenant les références et les libellés des farines
 */

////// Initialisation:
include_once "library/init.php";

////// Contrôle de session utilisateur:



////// Traitement:
// On récupére le catalogue des farines

$list_flours = Flour::getFlourCatalogue();

// On récupére la liste des recettes
$list = new Recipe();

$list_recipes = $list->getAll();

// On charge l'utilisateur connecté si la session est active, vide sinon
$user = User::getCurrentUser();

////// Affichage de la page:
include "templates/pages/homepage.php";