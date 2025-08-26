<?php

/**
 * Frag_detail_recipe fragment
 *
 * Fragment de page pour afficher les détails d'une recette
 *
 * Paramètres:
 *          - $detail_recipe: objet contenant les informations détaillées de la recette
 *          - $detail_flour: objet contenant les informations sur la farine utilisée dans la recette
 *          - $list_ingredients: liste des ingredients utilisés dans la recette incluant leurs quantités et unité de mesure
 *
 */

?>
<div class="recipe_title">
    <h2><?= $detail_recipe->get("title") ?></h2>
    <span>
        <?php
            if ($detail_recipe->get("update_date")) {
                $newDate = substr($detail_recipe->get("update_date"), 0, 10);
                $formattedDate = date("d/m/Y", strtotime($newDate));
                echo "mise à jour le: " . $formattedDate;
            } else {
                $newDate = substr($detail_recipe->get("creation_date"), 0, 10);
                $formattedDate = date("d/m/Y", strtotime($newDate));
                echo "créée le: " . $formattedDate;
            }
        ?>
    </span>
</div>
<div class="recipe_flour">
    <p><strong>Nom de farine: </strong> <?= htmlspecialchars($detail_flour["libelle"]) ?></p>
    <p><strong>Description: </strong> <?= htmlspecialchars($detail_flour["description"]) ?></p>
    <p><strong>Quantité: </strong> <?= htmlspecialchars($quantity_flour) ?> gr</p>
</div>
<div class="recipe_description">
    <h3>Description de la recette</h3>
    <p><?= $detail_recipe->get("description") ?></p>
    <span><strong>Temps d'exécution: </strong><?= $detail_recipe->get("execution_time") ?> minutes</span>
</div>
<div class="recipe_ingredients">
    <strong>Ingrédients:</strong>
    <ul>
        <?php foreach ($list_ingredients as $ingredient): ?>
            <li><?= $ingredient->get("reference") ?> <span><?= $ingredient->get("quantity") ?> <?= $ingredient->get("unit") ?></span></li>
        <?php endforeach; ?>
    </ul>
</div>