<?php

/**
 * ============================================================
 *  Contrôleur principal : index.php
 *  Rôle :
 *      - Prépare l'affichage de la page d'accueil (homepage)
 *
 *  Paramètres :
 *      - néant
 *
 *  Retour :
 *      - $list_recipes : tableau d'objets contenant les recettes (titre, id, difficulté, référence farine)
 *      - $list_flours : tableau associatif (références et libellés des farines)
 * ============================================================
 */

////// Initialisation:
include_once "library/init.php";


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
