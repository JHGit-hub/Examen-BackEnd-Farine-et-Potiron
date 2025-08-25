<?php

/**
 * Recipe template
 *
 * Template de page compléte pour afficher les détails d'une recette
 * Si on est le créateur, un bouton spécifique sera disponible pour la modifier
 * Sinon, on pourra laisser un commentaire (ou note) et eventuellement le(la) modifier
 * seulement si l'utilisateur est connecté et n'est pas le créateur
 *
 * Paramètres:
 *          - $user: objet contenant les informations de l'utilisateur
 *          - $detail_recipe: objet contenant les informations détaillées de la recette
 *          - $list_comments: tableau d'objet contenant  la liste des commentaires et notes de la recette
 */