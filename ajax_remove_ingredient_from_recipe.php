<?php

/**
 * Contrôleur AJAX
 *
 * Rôle:
 *      - Supprime un ingrédient d'une recette
 *
 * Paramètre:
 *      - (via $_GET)id: identifiant de l'ingrédient à supprimer
 *
 * Retourne:
 *      - fragment HTML généré par frag_list_current_ingredients.php
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
// On récupére l'id de l'ingredient (via $_GET)
$id = $_GET["id"] ?? 0;

// On charge l'objet ingredient selectionné
$ingredient = new Ingredient($id);

// On récupére l'id de la recette avant de supprimer l'ingrédient
$id_recipe = $ingredient->get("recipe_id")->id();

// On supprime l'ingrédient de la recette
$ingredient->delete($id);

// On recharge la liste des ingrédients de la recette avec la mise à jour
$ingredients = new Ingredient();

$list_current_ingredients = $ingredients->getIngredients($id_recipe);

///// Affichage du fragment HTML
include 'templates/fragments/list/frag_list_current_ingredients.php';
