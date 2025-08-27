<?php

/**
 * ============================================================
 *  Contrôleur : ajax_save_modif_comment.php
 *  Rôle :
 *      - Enregistre les modifications d'un commentaire.
 *
 *  Paramètres attendus :
 *      - (via $_POST) id : identifiant du commentaire à modifier
 *      - (via $_POST) content : nouveau contenu du commentaire
 *      - (via $_POST) rate : note du commentaire
 *
 *  Retourne :
 *      - $list_comments : tableau d’objets contenant les commentaires et/ou notes à afficher
 *      - fragment HTML généré par frag_list_comments.php
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

// On récupère l'id du commentaire
$id = $_POST["id"] ?? "";

// On instancie la classe Comment
$comment = new Comment($id);

// On récupère les données du formulaire
$comment->loadFromTab($_POST);

// On intégre la modification du commentaire à la base de données
$comment->update();

// On extrait l'id de la recette
$recipe_id = $comment->get("recipe_id")->id();

// On extrait le détail de la recette
$detail_recipe = new Recipe($recipe_id);

// On extrait les commentaires et notes de la recette
$comments = new Comment();
$list_comments = $comments->getComments($recipe_id);

// On affiche la page avec le nouveau commentaire
include "templates/fragments/list/frag_list_comments.php";
