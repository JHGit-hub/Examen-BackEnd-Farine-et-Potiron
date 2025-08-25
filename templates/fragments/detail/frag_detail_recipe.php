<?php

/**
 * Frag_detail_recipe fragment
 *
 * Fragment de page pour afficher les détails d'une recette
 *
 * Paramètres:
 *          - $detail_recipe: objet contenant les informations détaillées de la recette
 *          - $flour: objet contenant les informations sur la farine utilisée dans la recette
 *          - $list_ingredients: liste des ingredients utilisés dans la recette incluant leurs quantités et unité de mesure
 *
 */

?>
<div class="recipe_title">
    <h2><?= $detail_recipe->get("title") ?></h2>
    <span>
        <?php
            if ($detail_recipe->get("update_date")) {
                echo "mise à jour le: " . $detail_recipe->get("update_date");
            } else {
                echo "créée le: " . $detail_recipe->get("date");
            }
        ?>
    </span>
</div>
<div class="recipe_flour">
    <p><strong>Type de farine: </strong> <?= $flour->get("libelle") ?></p>
    <p><strong>Description: </strong> <?= $flour->get("description") ?></p>
</div>
<div class="recipe_description">
    <h3>Description de la recette</h3>
    <p><?= $detail_recipe->get("description") ?></p>
    <span><?= $detail_recipe->get("execution_time") ?></span>
</div>
<div class="recipe_ingredients">
    <p>Ingrédients:</p>
    <ul>
        <?php foreach ($list_ingredients as $ingredient): ?>
            <li><?= $ingredient->get("reference") ?><span><?= $ingredient->get("quantity") ?> <?= $ingredient->get("unit") ?></span></li>
        <?php endforeach; ?>
    </ul>
</div>