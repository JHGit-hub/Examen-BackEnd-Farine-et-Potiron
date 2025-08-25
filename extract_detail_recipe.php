<?php

/**
 * Contrôleur d'extraction de données
 *
 * Rôle:
 *      - extrait les détails d'une recette à partir de la base de données
 *      - extrait les commentaires et notes de cette recette
 *      - affiche un bouton modifier si l'utilisateur connecté et le créateur de la recette
 *
 * Paramètres:
 *      - (via $_GET)id: identifiant de la recette
 *
 * Retour:
 *      - $detail_recipe: objet contenant les détails de la recette
 *      - $list_comments: tableau d'objets contenant les commentaires et notes associés à la recette
 *      - $user: objet contenant les informations de l'utilisateur
 */
