<?php

/**
 * ============================================================
 *  Fragment : frag_form_create_recipe.php
 *  Rôle :
 *      - Affiche le formulaire de création d'une recette
 *
 *  Paramètres :
 *      - néant
 * ============================================================
 */

?>

<div class="recipe-title">
    <label for="title">Titre: </label>
    <input type="text" name="title" id="title" placeholder="Titre de la recette" required>
</div>
<div class="recipe-description">
    <label for="description">Description: </label>
    <textarea id="description" name="description" rows="5" cols="40" placeholder="Description de la recette" required></textarea>
</div>
<div class="recipe-description">
    <label for="execution_time">Temps de préparation (en minutes): </label>
    <input type="number" id="execution_time" name="execution_time" required>
</div>
<div class="recipe-description">
    <span>Difficulté: </span>

    <input type="radio" id="tres_facile" name="difficulty" value="très facile"required>
    <label for="tres_facile">Très facile</label>

    <input type="radio" id="facile" name="difficulty" value="facile">
    <label for="facile">Facile</label>

    <input type="radio" id="difficile" name="difficulty" value="difficile">
    <label for="difficile">Difficile</label>
</div>
<div>
    <?php
        include 'templates/fragments/form/frag_form_add_ingredients.php';
    ?>
</div>
<div id="list_ingredients"></div> <!-- frag_list_ingredients.php -->