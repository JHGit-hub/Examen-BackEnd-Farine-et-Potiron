<?php

/**
 * Contrôleur AJAX
 *
 * Rôle:
 *      - Prépare le formulaire de modification d'un commentaire et/ou note
 *
 * Paramètre:
 *      - (via $_GET)id: identifiant du commentaire et/ou note à modifier
 *
 * Retourne:
 *      - fragment HTML généré par frag_form_modif_comment.php
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
// On récupére l'id du commentaire à modifier (via $_GET)
$id = $_GET["id"] ?? "";

// On instancie et charge l'objet comment
$detail_comment = new Comment($id);

////// Affichage de la page:
include "templates/fragments/form/frag_form_modif_comment.php";