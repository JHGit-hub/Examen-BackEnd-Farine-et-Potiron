<?php

/**
 * Contrôleur d'enregistrement de données
 *
 * Rôle:
 *      - enregistre la nouvelle recette créée par l'utilisateur
 *
 * Paramètres:
 *      - (via $_POST) reference: reference de la farine
 *      - (via $_POST) title: titre de la recette
 *      - (via $_POST) execution_time: temps de préparation
 *      - (via $_POST) description: description détaillée de la recette
 *      - (via $_POST) difficulty: difficulté de la recette
 *      - (via $_SESSION) ingredients: ingredients necessaire à sa réalisation
 *
 * Retour:
 *      - néant
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

// On récupére les données du formulaire (via $_POST)
$reference = $_POST["reference"] ?? "";
$title = $_POST["title"] ?? "";
$execution_time = $_POST["execution_time"] ?? "";
$description = $_POST["description"] ?? "";
$difficulty = $_POST["difficulty"] ?? "";
$flour_quantity = $_POST["flour_quantity"] ?? "";
$flour_reference = $_POST["flour_reference"] ?? "";


//// On instancie la classe Recipe
$recipe = new Recipe();

// On charge les éléments de la recette
$recipe->set("user_id", $user_id);
$recipe->set("title", $title);
$recipe->set("execution_time", $execution_time);
$recipe->set("description", $description);
$recipe->set("difficulty", $difficulty);

// On enregistre la recette dans la base de données
$recipe->insert();

// On extrait l'id de la nouvelle recette créée
$recipe_id = $recipe->id();

////On instancie la classe Flour
$flour = new Flour();

// On charge les éléments de la farine
$flour->set("quantity", $flour_quantity);
$flour->set("reference", $flour_reference);
$flour->set("recipe_id", $recipe_id);

// On enregistre la farine de la recette dans la table flour
$flour->insert();

//// On enregistre les ingrédients de la recette dans la table ingredients
Ingredient::saveIngredientsFromArray($_SESSION["ingredients"], $recipe_id);

////// Redirection vers la controleur de la page de l'utilisateur
header('Location: init_user_page.php');
exit();