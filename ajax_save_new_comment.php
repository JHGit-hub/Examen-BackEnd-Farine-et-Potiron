<?php

/**
 * Contrôleur AJAX
 *
 * Rôle:
 *      - Enregistre un nouveau commentaire
 *
 * Paramètre:
 *      - (via $_POST)id: identifiant de la recette
 *      - (via $_POST)content: contenu du commentaire
 *      - (via $_POST)rate: note du commentaire
 *
 * Retourne:
 *      - fragment HTML généré par frag_list_comments.php
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
// On récupére l'id de l'utilisateur
$user_id = $session->idConnected();

// On instancie la class Comment
$comment = new Comment();

// On récupére les données du formulaire
$comment->loadFromTab($_POST);

// On intégre user_id dans $comment
$comment->set("user_id", $user_id);

// On intégre le nouveau commentaire à la base de données
$new_comment = $comment->insert();

// On extrait l'id de la recette
$recipe_id = $comment->get("recipe_id")->id();

// On extrait le détail de la recette
$detail_recipe = new Recipe($recipe_id);

// On extrait les commentaires et notes de la recette
$comments = new Comment();
$list_comments = $comments->getComments($recipe_id);

// On affiche la page avec le nouveau commentaire
include "templates/fragments/list/frag_list_comments.php";
