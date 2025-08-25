<?php

/**
 * Contrôleur d'enregistrement de données
 *
 * Rôle:
 *      - enregistre la nouvelle recette créée par l'utilisateur
 *
 * Paramètres:
 *      - (via $_POST) reference: reference de la farine
 *      - (via $_POST) title: titre de la recette
 *      - (via $_POST) execution_time: temps de préparation
 *      - (via $_POST) description: description détaillée de la recette
 *      - (via $_POST) difficulty: difficulté de la recette
 *      - (via $_SESSION) ingredients: ingredients necessaire à sa réalisation
 *
 * Retour:
 *      - néant
 */