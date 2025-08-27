<?php

/**
 * ============================================================
 *  Contrôleur : init_user_page.php
 *  Rôle :
 *      - Extrait la liste des recettes créées par l'utilisateur connecté
 *      - Extrait les commentaires et notes laissés par l'utilisateur connecté
 *
 *  Paramètres :
 *      - néant
 *
 *  Retour :
 *      - $list_recipes_created : tableau d'objets contenant les recettes créées par l'utilisateur
 *      - $list_recipes_rated : tableau d'objets contenant les recettes commentées et/ou notées par l'utilisateur
 *      - $user : objet contenant les informations de l'utilisateur
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

////// Traitement:
// On charge l'utilisateur connecté si la session est active, vide sinon
$user = User::getCurrentUser();

// On charge l'id de l'utilisateur connecté
$id = $session->idConnected();

// ON charge la liste des recettes créées par l'utilisateur connecté
$recipe = new Recipe();
$list_recipes_created = $recipe->getRecipesCreatedByUser($id);

// On charge la liste des commentaires et notes laissés par l'utilisateur connecté
$comment = new Comment();
$list_recipes_rated = $comment->getCommentsByUser($id);


////// Affichage de la page:
include "templates/pages/user_page.php";
