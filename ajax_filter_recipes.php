<?php

/**
 * ============================================================
 *  Contrôleur : ajax_filter_recipes.php
 *  Rôle :
 *      - Filtre les recettes en fonction des critères sélectionnés (difficulté ou nom de la farine).
 *
 *  Paramètres attendus :
 *      - (via $_GET) flour_1    : référence de la première farine sélectionnée
 *      - (via $_GET) flour_2    : référence de la deuxième farine sélectionnée
 *      - (via $_GET) difficulty : niveau de difficulté de la recette
 *
 *  Retourne :
 *      - fragment HTML généré par 'frag_list_recipes.php'
 *      - $list_recipes : tableau d’objets contenant les recettes filtrées selon les critères choisis
 * ============================================================
 */

////// Initialisation:
include_once "library/init.php";


////// Traitement:
// On récupére les paramètres
$flour1 = $_GET["flour_1"] ?? "";
$flour2 = $_GET["flour_2"] ?? "";
$difficulty = $_GET["difficulty"] ?? "";

// On instancie la classe Recipe
$recipes = new Recipe();

// On extrait la liste des recettes de la bdd
$list_recipes = $recipes->getRecipes($flour1, $flour2, $difficulty);

////// Affichage de la page:
include "templates/fragments/list/frag_list_recipes.php";
