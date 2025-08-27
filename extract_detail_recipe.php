<?php

/**
 * ============================================================
 *  Contrôleur : extract_detail_recipe.php
 *  Rôle :
 *      - Extrait les détails d'une recette à partir de la base de données
 *      - Extrait les commentaires et notes de cette recette
 *      - Affiche un bouton "modifier" si l'utilisateur connecté est le créateur de la recette
 *
 *  Paramètres attendus :
 *      - (via $_GET) id : identifiant de la recette
 *
 *  Retour :
 *      - $detail_recipe : objet contenant les détails de la recette
 *      - $list_comments : tableau d'objets contenant les commentaires et notes associés à la recette
 *      - $detail_flour : tableau associatif avec infos farine
 *      - $list_ingredients : tableau d'objets des ingrédients utilisés
 *      - $flour_from_recipe : objet quantité/référence de la farine utilisée
 * ============================================================
 */

////// Initialisation:
include_once "library/init.php";

////// Traitement

// On récupère l'id via $_GET
$recipe_id = $_GET["recipe_id"] ?? "";
$id = $_GET["id"] ?? "";

// si $recipe_id n'est pas vide, on attribue sa valeur à $id
if($recipe_id){
    $id = $recipe_id;
}
// On vide le tableau de la session s'il existe
// Pour vider la liste des ingrédients à ajouter a une recette
if (isset($_SESSION["ingredients"])) {
    $_SESSION["ingredients"] = [];
}

// On extrait le détail de la recette
$detail_recipe = new Recipe($id);

// On extrait les commentaires et notes de la recette
$comments = new Comment();
$list_comments = $comments->getComments($id);

// On extrait la liste des ingrédients de la recette
$ingredient = new Ingredient();
$list_ingredients = $ingredient->getIngredients($id);

// On extrait le détail de la farine contenu dans la recette
$flour = new Flour();
$flour_from_recipe = $flour->getFlourFromRecipe($id);

$reference = $flour_from_recipe->get("reference");

$detail_flour = $flour->getFlourDetail($reference);

////// Affichage de la page
include "templates/pages/recipe_page.php";