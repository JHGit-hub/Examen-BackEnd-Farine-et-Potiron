<?php
/**
 * ============================================================
 *  Contrôleur : ajax_save_modif_recipe.php
 *  Rôle :
 *      - Enregistre les modifications d'une recette (infos, farine, ingrédients).
 *
 *  Paramètres attendus :
 *      - (via $_POST) id : identifiant de la recette à modifier
 *      - (via $_POST) title : titre de la recette
 *      - (via $_POST) description : description de la recette
 *      - (via $_POST) execution_time : temps de préparation
 *      - (via $_POST) difficulty : difficulté de la recette
 *      - (via $_POST) ingredients : liste des ingrédients mise à jour
 *      - (via $_SESSION) ingredients : nouveaux ingrédients à ajouter
 *
 *  Retourne :
 *      - $detail_recipe : objet contenant les détails de la recette
 *      - $detail_flour : tableau associatif contenant les infos sur la farine utilisée
 *      - $list_ingredients : tableau d'objets, liste des ingrédients
 *      - $flour_from_recipe : objet avec quantité et référence de la farine
 *      - fragment HTML généré par frag_detail_recipe.php
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
// On récupére l'id de l'utilisateur connecté
$user_id = $session->idConnected();

//// modification de la recette
// On récupére l'id de la recette à modifier (via $_POST)
$id = $_POST["id"] ?? "";

// On instancie la classe recipe et charge l'objet $recipe_to_modify
$recipe_to_modify = new Recipe($id);

// On charge les éléments de la recette à modifier
$recipe_to_modify->loadFromTab($_POST);

// On met la recette à jour
$recipe_to_modify->update();

//// Modification de la farine
// On instancie la classe Flour
$flour = new Flour();

// On charge l'objet $flour_to_modify à partir de l'id de la recette
$flour_to_modify = $flour->getFlourFromRecipe($id);

// On charge les éléments de la farine à modifier
$flour_to_modify->loadFromTab($_POST);

// On met à jour la farine
$flour_to_modify->update();


//// Enregistrement des nouveaux ingrédients
// On enregistre les ingrédients de la recette dans la table ingredients
Ingredient::saveIngredientsFromArray($_SESSION["ingredients"], $id);

// On vide le tableau des ingrédients
$_SESSION["ingredients"] = [];

//// Chargment des données necessaires pour affichage
// On extrait le détail de la recette
$detail_recipe = new Recipe($id);


// On extrait la liste des ingredients de la recette
$ingredient = new Ingredient();
$list_ingredients = $ingredient->getIngredients($id);

// On extrait le détail de la farine contenu dans la recette
$flour_from_recipe = $flour->getFlourFromRecipe($id);

$reference = $flour_from_recipe->get("reference");

$detail_flour = $flour->getFlourDetail($reference);

////// Affichage du resultat
include 'templates/fragments/detail/frag_detail_recipe.php';

