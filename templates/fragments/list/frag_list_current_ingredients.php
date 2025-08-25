<?php

/**
 * Frag_list_current_ingredients fragment
 *
 * Fragment de page pour afficher la liste des ingrédients enregistrés d'une recette
 *
 * Paramètres:
 *          - $list_current_ingredients: tableau d'objet contenant les ingrédients enregistrés de la recette
 *
 */

?>


<div>
    <ul class='list_filtered'>
    <?php 
        foreach($list_current_ingredients as $current_ingredient): ?>
        <li class="card_ingredient">
            <div class="detail_ingredient">
                <h3><?= $current_ingredient->get("reference") ?></h3>
                <p><?= $current_ingredient->get("quantity") ?> <?= $current_ingredient->get("unit") ?></p>
            </div>
            <button onclick="removeCurrentIngredient('<?= $current_ingredient->id() ?>', 'list_current_ingredients')" class="delete-btn">Supprimer</button>
        </li>
    <?php 
        endforeach; 
    ?>
    </ul>
</div>