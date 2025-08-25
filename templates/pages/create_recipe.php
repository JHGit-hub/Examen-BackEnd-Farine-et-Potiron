<?php

/**
 * Form_create_recipe template
 *
 * Template de page compléte pour afficher le formulaire de création d'une recette
 *
 * Paramètres:
 *          - $list_flours: tableau associatif contenant la liste des farines disponibles
 *
 */

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create_recipe</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <div class="secondary_btn">
            <a href="index.php" class="close_btn logout_btn">
                <img src="../../../assets/icons/close.svg" alt="fermer la fenetre">
            </a>
        </div>
        <form class="form-filter">
            <label for="reference">Choisir une farine: </label>
            <?php
            echo _model::createSelect($list_flours, "reference", "flour", "Toutes les farines");
            ?>
            <button type="button" onclick="showDetailFlour(event, 'create_recipe','detail_flour')" class="secondary_btn">Voir détails</button>
        </form>
    </header>
    <main>
        <form method="post" action="save_new_recipe.php">
            <div class="hidden"id="detail_flour"></div> <!-- frag_detail_flour -->
            <div class="hidden" id="form_create_recipe"></div> <!-- frag_form_create_recipe -->
            <div>
                <button type="submit" class="secondary_btn open_btn">Enregistrer</button>
            </div>
        </form>


    </main>
    <script src="js/functions.js" type="text/javascript"></script>
</body>

</html>