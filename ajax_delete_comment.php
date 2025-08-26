<?php

/**
 * Contrôleur AJAX
 *
 * Rôle:
 *      - Supprime le commentaire
 *
 * Paramètre:
 *      - (via $_GET) id: identifiant du commentaire à supprimer
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

// On récupére l'id du commentaire
$id = $_GET["id"] ?? "";

// On instancie la class Comment
$comment = new Comment($id);

// On extrait l'id de la recette
$recipe_id = $comment->get("recipe_id")->id();

// On suprrime le commentaire de la base de données
$comment->delete();

// On extrait le détail de la recette
$detail_recipe = new Recipe($recipe_id);

// On extrait les commentaires et notes de la recette
$comments = new Comment();
$list_comments = $comments->getComments($recipe_id);

// On affiche la page avec le nouveau commentaire
include "templates/fragments/list/frag_list_comments.php";
