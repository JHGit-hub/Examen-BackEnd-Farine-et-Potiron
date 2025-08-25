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
