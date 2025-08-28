<?php

/**
 * ============================================================
 *  Template : recipe_page.php
 *  Rôle :
 *      - Affiche les détails d'une recette, la farine, les ingrédients et les commentaires.
 *      - Si on est le créateur : bouton "Modifier la recette".
 *      - Si utilisateur connecté mais pas créateur : possibilité de commenter ou modifier son commentaire.
 *
 *  Paramètres attendus :
 *      - $detail_recipe : objet contenant les détails de la recette
 *      - $list_comments : tableau d'objets contenant les commentaires et notes associés à la recette
 *      - $detail_flour : tableau associatif avec infos farine
 *      - $list_ingredients : tableau d'objets des ingrédients utilisés
 *      - $flour_from_recipe : objet quantité/référence de la farine utilisée
 * ============================================================
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
                <button class="secondary-btn" onclick="showFormModifRecipe(<?= $detail_recipe->id() ?>, 'modif_recipe')">Modifier la recette</button>
            <?php
            }
            ?>
        </div>
        <div class="secondary-btn">
            <a href="index.php" class="close-btn logout-btn">
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
        </div>
        <div id="list_comments">
            <?php include 'templates/fragments/list/frag_list_comments.php'; ?>
        </div>
        <div id="modal_background" class="modal_background hidden"></div>
    </main>
    <script src="js/functions.js" type="text/javascript"></script>
</body>

</html>