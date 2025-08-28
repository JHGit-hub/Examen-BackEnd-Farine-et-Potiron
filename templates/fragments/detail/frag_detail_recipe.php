<?php

/**
 * ============================================================
 *  Fragment : frag_detail_recipe.php
 *  Rôle global :
 *      - Affiche les détails d'une recette : titre, dates, farine utilisée, description, temps d'exécution et liste des ingrédients.
 *
 *  Paramètres attendus :
 *      - $detail_recipe : objet contenant les détails de la recette
 *      - $detail_flour : tableau associatif contenant les informations sur la farine utilisée dans la recette
 *      - $list_ingredients : tableau d'objets incluant la liste des ingrédients utilisés dans la recette
 *      - $flour_from_recipe : objet contenant la quantité et la référence de la farine utilisée dans la recette
 * ============================================================
 */

?>
<div class='recipe-img'>
    <img src="assets/images/recipe_default.png" alt="image de recette par defaut">
</div>
<div class="recipe-title">
    <h2><?= htmlspecialchars($detail_recipe->get("title")) ?></h2>
    <span>
        <?php
        if ($detail_recipe->get("update_date")) {
            $newDate = substr($detail_recipe->get("update_date"), 0, 10);
            $formattedDate = date("d/m/Y", strtotime($newDate));
            echo "mise à jour le : " . $formattedDate;
        } else {
            $newDate = substr($detail_recipe->get("creation_date"), 0, 10);
            $formattedDate = date("d/m/Y", strtotime($newDate));
            echo "créée le : " . $formattedDate;
        }
        ?>
    </span>
</div>
<div class="recipe-flour">
    <p><strong>Nom de farine : </strong> <?= htmlspecialchars($detail_flour["libelle"]) ?></p>
    <p><strong>Description : </strong> <?= htmlspecialchars($detail_flour["description"]) ?></p>
    <p><strong>Quantité : </strong> <?= htmlspecialchars($flour_from_recipe->get("quantity")) ?> gr</p>
</div>
<div class="recipe-description">
    <h3>Description de la recette</h3>
    <p><?= htmlspecialchars($detail_recipe->get("description")) ?></p>
    <span><strong>Temps d'exécution : </strong><?= htmlspecialchars($detail_recipe->get("execution_time")) ?> minutes</span>
    <span><strong>Difficulté : </strong><?= htmlspecialchars($detail_recipe->get("difficulty")) ?></span>
</div>
<div class="recipe-ingredients">
    <strong>Ingrédients :</strong>
    <ul>
        <?php foreach ($list_ingredients as $ingredient): ?>
            <li><?= htmlspecialchars($ingredient->get("reference")) ?> <span><?= htmlspecialchars($ingredient->get("quantity")) ?> <?= htmlspecialchars($ingredient->get("unit")) ?></span></li>
        <?php endforeach; ?>
    </ul>
</div>