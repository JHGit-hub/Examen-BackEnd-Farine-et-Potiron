<?php

/**
 * Contrôleur AJAX
 *
 * Rôle:
 *      - Enregistre les modifications d'une recette
 *
 * Paramètre:
 *      - (via $_POST)id: identifiant de la recette à modifier
 *      - (via $_POST)title: titre de la recette
 *      - (via $_POST)description: description de la recette
 *      - (via $_POST)execution_time: temps de préparation
 *      - (via $_POST)difficulty: difficulté de la recette
 *      - (via $_POST)ingredients: liste des ingrédients de la recette mise à jour
 *      - (via $_SESSION)new_ingredients: nouveaux ingrédients de la recette à ajouter
 *
 * Retourne:
 *      - fragment HTML généré par frag_detail_recipe.php
 */
