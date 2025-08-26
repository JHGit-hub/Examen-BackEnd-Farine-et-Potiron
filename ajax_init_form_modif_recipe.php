<?php

/**
 * Contrôleur AJAX
 *
 * Rôle:
 *      - Prépare le formulaire de modification d'une recette
 *
 * Paramètre:
 *      - (via $_GET)id: identifiant de la recette à modifier
 *
 * Retourne:
 *      - fragment HTML généré par frag_form_modif_recipe.php
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
// On récupére l'id de la recette à modifier (via $_GET)
$id = $_GET["id"] ?? 0;

// On extrait le détail de la recette à modifier
$detail_recipe = new Recipe($id);

// On extrait la liste des ingredients de cette recette
$ingredients = new Ingredient();

$list_current_ingredients = $ingredients->getIngredients($id);

// On récupére le catalogue des farines
$list_flours = Flour::getFlourCatalogue();

// On récupére le détail de la farine utilisée dans cette recette
$flour = new Flour();
$detail_flour = $flour->getFlourReferenceAndQuantityById($id);


////// Affichage de la page
include "templates/fragments/form/frag_form_modif_recipe.php";