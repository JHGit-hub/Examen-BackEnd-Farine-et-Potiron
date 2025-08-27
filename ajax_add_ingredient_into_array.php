<?php

/**
 * ============================================================
 *  Contrôleur : ajax_add_ingredient_into_array.php
 *  Rôle :
 *      - Stocke les détails d’un ingrédient de recette dans un tableau associatif de la session $_SESSION.
 *      - Génère et retourne le fragment HTML de la liste d’ingrédients actualisée.
 *
 *  Paramètres attendus :
 *      - (via $_GET) reference : nom de l’ingrédient à ajouter
 *      - (via $_GET) quantity  : quantité de l’ingrédient à ajouter
 *      - (via $_GET) unit      : unité de mesure à ajouter
 *
 *  Retourne :
 *      - $list_ingredients : tableau de tableaux associatifs contenant les ingrédients à afficher.
 *      - Fragment HTML généré par 'frag_list_ingredients.php', affichant la liste à jour.
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
$quantity = $_GET["quantity"] ?? "";
$unit = $_GET["unit"] ?? "";

// On ajoute l'ingrédient dans le tableau de la session
// Si le tableau n'existe pas, on le crée
if (!isset($_SESSION["ingredients"])) {
    $_SESSION["ingredients"] = [];
}

// Et on ajoute l'ingredient dans ce tableau
$_SESSION["ingredients"][] = [
    "reference" => $reference,
    "quantity" => $quantity,
    "unit" => $unit
];

// On prépare le tableau des ingredients à envoyer
$list_ingredients = $_SESSION["ingredients"];

////// Affichage du fragment HTML
include "templates/fragments/list/frag_list_ingredients.php";
