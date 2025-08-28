<?php

/**
 * ============================================================
 *  Fragment : frag_list_current_ingredients.php
 *  Rôle global :
 *      - Affiche la liste des ingrédients enregistrés d'une recette.
 *      - Permet de supprimer un ingrédient avec le bouton associé.
 *
 *  Paramètre attendu :
 *      - $list_current_ingredients : tableau d'objets contenant les ingrédients enregistrés de la recette
 * ============================================================
 */

?>


<div>
    <ul class='list-filtered'>
    <?php 
        foreach($list_current_ingredients as $current_ingredient): ?>
        <li class="card-ingredient">
            <div class="detail-ingredient">
                <h3><?= htmlspecialchars($current_ingredient->get("reference")) ?></h3>
                <p><?= htmlspecialchars($current_ingredient->get("quantity")) ?> <?= htmlspecialchars($current_ingredient->get("unit")) ?></p>
            </div>
            <button onclick="removeCurrentIngredient('<?= $current_ingredient->id() ?>', 'list_current_ingredients')" class="delete-btn">Supprimer</button>
        </li>
    <?php 
        endforeach; 
    ?>
    </ul>
</div>