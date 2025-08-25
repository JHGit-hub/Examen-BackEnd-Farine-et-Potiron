<?php

/**
 * Contrôleur d'extraction de données
 *
 * Rôle:
 *      - Extrait la liste des recettes créées par l'utilisateur connecté
 *      - Extrait les commentaires et notes laissés par l'utilisateur connecté
 *
 * Paramètres:
 *      - néant
 *
 * Retour:
 *      - $list_recipes_created: tableau d'objets contenant les recettes créées par l'utilisateur
 *      - $list_recipes_rated: tableau d'objets contenant les recettes commentées et /ou notées par l'utilisateur
 *      - $user: objet contenant les informations de l'utilisateur
 */