<?php

/**
 * Frag_list_ingredients fragment
 *
 * Fragment de page pour afficher la liste des ingrédients à ajouter à une recette
 * On pourra supprimer les ingrédients de cette liste grâce à un bouton "Supprimer"
 *
 * Paramètres:
 *          - $list_ingredients: tableau de tableaux associatifs contenant les ingrédients à ajouter à la recette
 *
 */

?>
<div>
    <div class='list_filtered'>
    <?php 
        foreach($list_ingredients as $ingredient): ?>
        <div class="card_ingredient">
            <div class="detail_ingredient">
                <h3><?= $ingredient['reference'] ?></h3>
                <p><?= $ingredient['quantity'] ?> <?= $ingredient['unit'] ?></p>
            </div>
            <button onclick="removeIngredient('<?= $ingredient['reference'] ?>', 'list_ingredients')" class="delete-btn">Supprimer</button>
        </div>
    <?php 
        endforeach; 
    ?>
    </div>
</div>