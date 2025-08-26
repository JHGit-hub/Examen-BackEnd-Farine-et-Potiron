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
 *      - $user: objet contenant les informations de l'utilisateur
 *      - $detail_flour: objet contenant les informations sur la farine utilisée dans la recette
 *      - $list_ingredients: liste des ingredients utilisés dans la recette incluant leurs quantités et unité de mesure
 */

////// Initialisation:
include_once "library/init.php";

////// Traitement
// On charge l'utilisateur connecté si la session est active, vide sinon
$user = User::getCurrentUser();

// On récupére l'id via $_GET
$id = $_GET["id"] ?? 0;

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
$flour_used = $flour->getFlourReferenceAndQuantityById($id);

$detail_flour = $flour->getFlourDetail($flour_used["reference"]);
$quantity_flour = $flour_used["quantity"];


////// Affichage de la page
include "templates/pages/recipe_page.php";