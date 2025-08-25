<?php

/**
 * Contrôleur AJAX
 *
 * Rôle:
 *      - Filtre les recettes en fonction des critères selectionnées (difficulté ou nom de la farine)
 *
 * Paramètres:
 *          - (via $_GET)reference: reference de la farine selectionnée
 *          - (via $_GET)difficulty: niveau de difficulté de la recette
 *
 * Retourne:
 *          - fragment HTML généré par frag_list_recipes.php
 *          - $list_recipes_filtered: tableau d'objets contenant les recettes filtrées selon les critères choisis
 */
