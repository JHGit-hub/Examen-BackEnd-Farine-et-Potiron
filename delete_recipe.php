<?php

/**
 * Contrôleur de suppression de données
 *
 * Rôle:
 *      - supprime la recette sélectionnée par l'utilisateur
 *
 * Paramètres:
 *      - (via $_GET) id: id de la recette
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
// On récupére l'id de la recette à supprimer
$recipe_id = $_GET["id"] ?? 0;


// On supprime la recette et tous les ingredients liés
Recipe::deleteRecipeById($recipe_id);

// Redirection vers la page de l'utilisateur
header('Location: init_user_page.php');
exit();