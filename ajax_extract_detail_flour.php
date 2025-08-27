<?php

/**
 * ============================================================
 *  Contrôleur : ajax_extract_detail_flour.php
 *  Rôle :
 *      - Récupère les détails d'une farine sélectionnée à partir de l'API.
 *
 *  Paramètre attendu :
 *      - (via $_GET) reference : référence de la farine à extraire.
 *
 *  Retourne :
 *      - $detail_flour : tableau associatif du détail de la farine issu de l'API.
 *      - Fragment HTML généré par 'frag_detail_flour.php'.
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

// On récupére la référence de la farine (via $_GET)
$reference = $_GET["reference"] ?? "";

// On extrait le détail de la farine selectionnée
$flour = new Flour();

$detail_flour = $flour->getFlourDetail($reference);



////// Affichage de la page
include "templates/fragments/detail/frag_detail_flour.php";
