<?php

/**
 * ============================================================
 *  Contrôleur : ajax_init_form_modif_recipe.php
 *  Rôle :
 *      - Prépare le formulaire de modification d'une recette.
 *
 *  Paramètre attendu :
 *      - (via $_GET) id : identifiant de la recette à modifier
 *
 *  Retourne :
 *      - $detail_recipe : objet contenant les informations de la recette à modifier
 *      - $list_flours : tableau associatif contenant les types de farine disponibles
 *      - $flour_from_recipe : objet contenant les informations sur la farine utilisée dans la recette
 *      - $list_current_ingredients : tableau d'objets contenant les ingrédients enregistrés de la recette
 *      - fragment HTML généré par frag_form_modif_recipe.php
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
$flour_from_recipe = $flour->getFlourFromRecipe($id);


////// Affichage de la page
include "templates/fragments/form/frag_form_modif_recipe.php";