<?php

/**
 * Contrôleur AJAX 
 * 
 * Rôle:
 *      - Stocke les détails de l'ingredient de la recette dans un tableau associatif de la session $_SESSION
 *
 * Paramètres:
 *          - (via $_POST)reference: nom de l'ingrédient à ajouter
 *          - (via $_POST)quantity: quantité de l'ingrédient à ajouter
 *          - (via $_POST)unit: unité de mesure de l'ingrédient à ajouter
 *
 * Retourne:
 *          - fragment HTML généré par frag_list_ingredients.php
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
