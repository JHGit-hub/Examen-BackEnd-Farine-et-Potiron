<?php

/**
 * ============================================================
 *  Contrôleur : delete_recipe.php
 *  Rôle :
 *      - Supprime la recette sélectionnée par l'utilisateur ainsi que tous les ingrédients liés.
 *
 *  Paramètre attendu :
 *      - (via $_GET) id : identifiant de la recette
 *
 *  Retour :
 *      - néant (redirection vers la page utilisateur)
 * ============================================================
 */

////// Initialisation:
include_once "library/init.php";

////// Contrôle de session utilisateur:
if (!$session->isLogged()) {
    // L'utilisateur n'est PAS connecté
    header('Location: index.php');
    exit();
}

////// Traitement
// On récupère l'id de la recette à supprimer
$recipe_id = $_GET["id"] ?? 0;


// On supprime la recette et tous les ingredients liés
Recipe::deleteRecipeById($recipe_id);

// Redirection vers la page de l'utilisateur
header('Location: init_user_page.php');
exit();