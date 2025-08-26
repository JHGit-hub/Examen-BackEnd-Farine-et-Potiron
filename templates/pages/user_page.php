<?php

/**
 * User_page template
 *
 * Template de page compléte pour afficher les informations de l'utilisateur
 * On y affichera la liste des recettes créées par l'utilisateur et
 * celles qu'il a commentées et/ou notées
 *
 * Paramètres:
 *          - $user: objet contenant les informations de l'utilisateur
 *          - $list_recipes_rated: tableau d'objets contenant les recettes commentées et /ou notées par l'utilisateur
 *          - $list_recipes_created: tableau d'objets contenant les recettes créées par l'utilisateur
 *
 */

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User_page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <div id="edit_profil">
            <?php
            include "templates/fragments/header/frag_edit_profil.php";
            ?>
        </div>
        <a href="extract_list_flours.php" class="secondary_btn">Créer une nouvelle recette</a>
    </header>
    <main>
        <div class="modal hidden" id="modif_profil"></div> <!-- frag_form_modif_profil.php -->
        <?php
        echo _model::createListFiltered($list_recipes_created, "extract_detail_recipe.php", "id", "title", "date", true);

        ?>
        <div class="list_filtered rated">
            <?php
            foreach ($list_recipes_rated as $comment) {
                $recipe_id = $comment->get("recipe_id")->id();
            ?>
                <a href="extract_detail_recipe.php?recipe_id=<?= htmlspecialchars($recipe_id) ?>" class="card_recipe">
                    <h3><?= htmlspecialchars($comment->get("recipe_id")->get("title")) ?></h3>
                    <?php
                    if ($comment->get("update_date")) {
                        $newDate = substr($comment->get("update_date"), 0, 10);
                        $formattedDate = date("d/m/Y", strtotime($newDate));
                        echo "mise à jour le: " . $formattedDate;
                    } else {
                        $newDate = substr($comment->get("creation_date"), 0, 10);
                        $formattedDate = date("d/m/Y", strtotime($newDate));
                        echo "créée le: " . $formattedDate;
                    }
                    ?>
                </a>
            <?php
            }
            ?>
        </div>
        <div id="modal_background" class="modal_background hidden"></div>
    </main>
    <script src="js/functions.js" type="text/javascript"></script>
</body>

</html>