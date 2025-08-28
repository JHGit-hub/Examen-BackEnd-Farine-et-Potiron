<?php

/**
 * ============================================================
 *  Fragment : frag_list_recipes.php
 *  Rôle global :
 *      - Affiche la liste des recettes (toutes ou filtrées selon les critères).
 *
 *  Paramètre attendu :
 *      - $list_recipes : tableau d’objets contenant les recettes à afficher.
 *
 * ============================================================
 */

?>


<?php foreach ($list_recipes as $recipe): ?>
    <a href="extract_detail_recipe.php?id=<?= $recipe->id(); ?>">
        <div class='card-recipe'>
            <div class='card-img'>
                <img src="assets/images/recipe_default.png" alt="image de recette par defaut">
            </div>
            <div class='card-content'>
                <h3 class="card-title"><?= htmlspecialchars($recipe->get('title')); ?></h3>
                <p class="card-author"><strong>Créée par : </strong><?= htmlspecialchars($recipe->get('user_id')->get("username")); ?></p>
                <p class="card-date">
                    <?php
                    if ($recipe->get("update_date")) {
                        $newDate = substr($recipe->get("update_date"), 0, 10);
                        $formattedDate = date("d/m/Y", strtotime($newDate));
                        echo "mise à jour le : " . $formattedDate;
                    } else {
                        $newDate = substr($recipe->get("creation_date"), 0, 10);
                        $formattedDate = date("d/m/Y", strtotime($newDate));
                        echo "créée le : " . $formattedDate;
                    }
                    ?>
                    </span>
                <p class="card-difficulty">Difficulté: <?= htmlspecialchars($recipe->get('difficulty')); ?></p>
            </div>
        </div>
    </a>
<?php endforeach; ?>

<?php

/*
<?php

echo _model::createListFiltered($list_recipes, "extract_detail_recipe.php", "id", "title", "difficulty", false);
?>


<?php


<?php foreach($list_recipes as $recipe): ?>
    <a href = "extract_detail_recipe.php?id=<?= $recipe->id(); ?>">
        <div class='card_recipe'>
            <div class='card_img'>
                <img src="assets/images/recipe_default.php" alt="image de recette par defaut">
            </div>
            <div class='card_content'>
                <h3><?= htmlspecialchars($recipe->get('title')); ?></h3>
                <p><strong>Créée par : </strong><?= htmlspecialchars($recipe->get('user_id')->get("username")); ?></p>
                <span>
                    <?php
                    if ($recipe->get("update_date")) {
                        $newDate = substr($recipe->get("update_date"), 0, 10);
                        $formattedDate = date("d/m/Y", strtotime($newDate));
                        echo "mise à jour le : " . $formattedDate;
                    } else {
                        $newDate = substr($recipe->get("creation_date"), 0, 10);
                        $formattedDate = date("d/m/Y", strtotime($newDate));
                        echo "créée le : " . $formattedDate;
                    }
                    ?>
                </span>
                <p>Difficulté: <?= htmlspecialchars($recipe->get('difficulty')); ?></p>
            </div>
        </div>
    </a>
<?php endforeach; ?>





*/
?>