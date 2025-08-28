<?php

/**
 * ============================================================
 *  Template : user_page.php
 *  Rôle :
 *      - Affiche les informations de l'utilisateur connecté
 *      - Affiche la liste des recettes créées par l'utilisateur
 *      - Affiche la liste des recettes commentées et/ou notées par l'utilisateur
 *
 *  Paramètres attendus :
 *      - $user : objet contenant les informations de l'utilisateur
 *      - $list_recipes_rated : tableau d'objets contenant les recettes commentées et/ou notées
 *      - $list_recipes_created : tableau d'objets contenant les recettes créées
 * ============================================================
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
        <div class="navbar">
            <?php
            include "templates/fragments/header/frag_header_user_connected.php";
            ?>
        </div>
        <div id="edit_profil">
            <?php
            include "templates/fragments/header/frag_edit_profil.php";
            ?>
        </div>
        <a href="extract_list_flours.php" class="secondary-btn">Créer une nouvelle recette</a>
    </header>
    <main>
        <div class="modal hidden" id="modif_profil"></div> <!-- frag_form_modif_profil.php -->
        <h2>Recettes créées</h2>
        <div class="list-created">
            <?php
            foreach ($list_recipes_created as $recipe) {
                $recipe_id = $recipe->id();
            ?>
                <a href="extract_detail_recipe.php?recipe_id=<?= htmlspecialchars($recipe_id) ?>" class="card-recipe">
                    <h3><?= htmlspecialchars($recipe->get("title")) ?></h3>
                    <?php
                    if ($recipe->get("update_date")) {
                        $newDate = substr($recipe->get("update_date"), 0, 10);
                        $formattedDate = date("d/m/Y", strtotime($newDate));
                        echo "mise à jour le: " . $formattedDate;
                    } else {
                        $newDate = substr($recipe->get("creation_date"), 0, 10);
                        $formattedDate = date("d/m/Y", strtotime($newDate));
                        echo "créée le: " . $formattedDate;
                    }
                    ?>
                </a>
            <?php
            }
            ?>
        </div>
        <h2>Recettes commentées / notées</h2>
        <div class="list-rated">
            <?php
            foreach ($list_recipes_rated as $comment) {
                $recipe_id = $comment->get("recipe_id")->id();
            ?>
                <a href="extract_detail_recipe.php?recipe_id=<?= htmlspecialchars($recipe_id) ?>" class="card-recipe">
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