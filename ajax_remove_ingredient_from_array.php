<?php

/**
 * ============================================================
 *  Contrôleur : ajax_remove_ingredient_from_array.php
 *  Rôle :
 *      - Supprime un ingrédient du tableau des ingrédients enregistré en session.
 *
 *  Paramètre attendu :
 *      - (via $_GET) reference : nom (référence) de l'ingrédient à supprimer
 *
 *  Retourne :
 *      - $list_ingredients : tableau de tableaux associatifs contenant les ingrédients à afficher.
 *      - fragment HTML généré par frag_list_ingredients.php
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
// On récupére les données de l'ingrédient (via $_GET)
$reference = $_GET["reference"] ?? "";

// On parcours le tableau des ingrédients
if (isset($_SESSION["ingredients"])) {
    foreach ($_SESSION["ingredients"] as $key => $ingredient) {
        if ($ingredient["reference"] === $reference) {
            // Si on trouve l'ingrédient, on le supprime
            unset($_SESSION["ingredients"][$key]); // unset supprime l'élément du tableau
        }
    }
}

// On réindexe le tableau
$_SESSION["ingredients"] = array_values($_SESSION["ingredients"]);

// On prépare le tableau des ingredients à envoyer
$list_ingredients = $_SESSION["ingredients"];

////// Affichage du fragment HTML
include "templates/fragments/list/frag_list_ingredients.php";
