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
 *      - $detail_recipe: objet contenant les détails de la recette
 *      - $list_comments: tableau d'objets contenant les commentaires et notes associés à la recette
 *      - $user: objet contenant les informations de l'utilisateur
 *      - $detail_flour: objet contenant les informations sur la farine utilisée dans la recette
 *      - $list_ingredients: liste des ingredients utilisés dans la recette incluant leurs quantités et unité de mesure
 */


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recipe_page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <div>
            <?php
            if ($session->isLogged()) {
                // On affiche le header de l'utilisateur connecté
                include "templates/fragments/header/frag_header_user_connected.php";
            }
            if ($session->idConnected() === $detail_recipe->get("user_id")->id()) {
                // On affiche le bouton modifier la recette 
            ?>
                <button class="secondary_btn" onclick="showFormModifRecipe(<?= $detail_recipe->id() ?>, 'modif_recipe')">Modifier la recette</button>
            <?php
            }
            ?>
        </div>
        <div class="secondary_btn">
            <a href="index.php" class="close_btn logout_btn">
                <img src="../../../assets/icons/close.svg" alt="fermer la fenetre">
                <span>retour à l'accueil</span>
            </a>
        </div>
    </header>
    <main>
        <div class="modal hidden" id="modif_recipe"></div> <!-- frag_form_modif_recipe.php -->
        <div class="modal hidden" id="modif_comment"></div> <!-- frag_form_modif_comment.php -->
        <div id="detail_recipe">
            <?php include 'templates/fragments/detail/frag_detail_recipe.php'; ?>
        </div> <!-- frag_detail_recipe.php -->
        <div id="list_comments">
            <?php include 'templates/fragments/list/frag_list_comments.php'; ?>
        </div> <!-- frag_list_comments.php -->
            <!-- ICI le code retiré -->
    </main>
    <script src="js/functions.js" type="text/javascript"></script>
</body>

</html>