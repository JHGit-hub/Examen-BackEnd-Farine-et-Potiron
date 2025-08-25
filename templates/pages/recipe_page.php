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
 *          - $detail_recipe: objet contenant les informations détaillées de la recette
 *          - $list_comments: tableau d'objet contenant  la liste des commentaires et notes de la recette
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
                if($session->idConnected() === $detail_recipe->get("user_id")->id()){
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
            </a>
        </div>
    </header>
    <main>
        <div id="detail_recipe"></div> <!-- frag_detail_recipe.php -->
        <div id="list_comments"></div> <!-- frag_list_comments.php -->
        <?php
            if($session->isLogged()){
                $hasCommented = false; // initialisation de la variable $hasCommented
                foreach($list_comments as $comment){
                    if($session->idConnected() === $comment->get("user_id")->id()){
                        // On affiche le bouton modifier son commentaire
                        $hasCommented = true;
                        ?>
                            <button class="secondary_btn" onclick="showFormModifComment(<?= $comment->id() ?>, 'modif_comment')">Modifier le commentaire</button>
                        <?php
                    }
                }
                if(!$hasCommented){ // n'a pas commenté
                    // On affiche un formulaire pour ajouter un commentaire
                    ?>
                        <form id="form_new_comment">
                            <label for="rate">Note (0 à 5)</label>
                            <input type="number" name="rate" min="0" max="5" step="1" required>

                            <textarea name="comment" rows="5" cols="40"placeholder="Ajouter un commentaire"></textarea>
                            <button type="button"onclick="recordNewComment(event, 'form_new_comment', 'list_comments')" class="secondary_btn">Enregistrer</button>
                        </form>
                    <?php
                }
            }
        ?>
    </main>
    <script src="js/functions.js" type="text/javascript"></script>
</body>

</html>