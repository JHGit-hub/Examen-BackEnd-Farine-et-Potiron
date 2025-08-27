<?php

/**
 * Contrôleur d'extraction de données
 *
 * Rôle:
 *      - extrait les détails d'une recette à partir de la base de données
 *      - extrait les commentaires et notes de cette recette
 *      - affiche un bouton modifier si l'utilisateur connecté et le créateur de la recette
 *
 * Paramètres:
 *      - (via $_GET)id: identifiant de la recette
 *
 * Retour:
 *      - $detail_recipe: objet contenant les détails de la recette
 *      - $list_comments: tableau d'objets contenant les commentaires et notes associés à la recette
 *      - $detail_flour: tableau associatif contenant les informations sur la farine utilisée dans la recette
 *      - $list_ingredients: tableau d'objets incluant la liste des ingredients utilisés dans la recette
 *      - $flour_from_recipe: objet contenant la quantité et la référence de la farine utilisée dans la recette
 */

////// Initialisation:
include_once "library/init.php";

////// Traitement

// On récupére l'id via $_GET
$recipe_id = $_GET["recipe_id"] ?? "";
$id = $_GET["id"] ?? "";

// si $recipe_id n'est pas vide, on attribue sa valeur à $id
if($recipe_id){
    $id = $recipe_id;
}
// On vide le tableau de la session s'il existe
// Pour vider la liste des ingredients à ajouter a une recette
if (isset($_SESSION["ingredients"])) {
    $_SESSION["ingredients"] = [];
}

// On extrait le détail de la recette
$detail_recipe = new Recipe($id);

// On extrait les commentaires et notes de la recette
$comments = new Comment();
$list_comments = $comments->getComments($id);

// On extrait la liste des ingredients de la recette
$ingredient = new Ingredient();
$list_ingredients = $ingredient->getIngredients($id);

// On extrait le détail de la farine contenu dans la recette
$flour = new Flour();
$flour_from_recipe = $flour->getFlourFromRecipe($id);

$reference = $flour_from_recipe->get("reference");

$detail_flour = $flour->getFlourDetail($reference);

////// Affichage de la page
include "templates/pages/recipe_page.php";