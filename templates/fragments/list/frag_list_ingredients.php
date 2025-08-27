
<?php
/**
 * ============================================================
 *  Fragment : frag_list_ingredients
 *  Rôle global :
 *      - Affiche la liste des ingrédients à ajouter à une recette sous forme de liste HTML.
 *      - Permet la suppression d’un ingrédient via un bouton "Supprimer" (action JS).
 *
 *  Paramètre attendu :
 *      - $list_ingredients : tableau de tableaux associatifs contenant les ingrédients à afficher.
 *
 *  Fonctionnalités principales :
 *      - Parcours du tableau $list_ingredients et affichage de chaque ingrédient (référence, quantité, unité).
 *      - Bouton associé à chaque ingrédient pour le retirer dynamiquement de la liste.
 *
 * ============================================================
 */
?>

<div>
    <ul class='list_filtered'>
        <?php 
            foreach($list_ingredients as $ingredient): ?>
            <li class="card_ingredient">
                <div class="detail_ingredient">
                    <h3><?= $ingredient['reference'] ?></h3>
                    <p><?= $ingredient['quantity'] ?> <?= $ingredient['unit'] ?></p>
                </div>
                <button onclick="removeIngredient(event,'<?= $ingredient['reference'] ?>', 'list_ingredients')" class="delete-btn">Supprimer</button>
            </li>
        <?php 
            endforeach; 
        ?>
    </ul>
</div>
