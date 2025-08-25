<?php

/**
 * Frag_form_add_ingredients fragment
 *
 * Fragment de page pour afficher le formulaire de création et d'ajout d'un ingrédient à la recette
 * On va attribué un id different au formulaire selon si la recette existe déjà (on la modifie) ou si on la créé
 *
 * Paramètres:
 *          - $id; id de la recette si elle existe dèjà
 *
 */

?>

<div id="form_add_ingredient">
    <label for="reference">Nom de l'ingrédient: </label>
    <input type="text" name="reference" id="reference" placeholder="Nom de l'ingrédient" required>

    <label for="quantity">Quantité: </label>
    <input type="number" step="any" name="quantity" id="quantity" placeholder="Quantité" required>

    <label for="unit">Unité: </label>
    <input type="text" name="unit" placeholder="Unité" required>

    <button type="button" onclick="addIngredient(event, 'list_ingredients')" class="secondary_btn">Ajouter l'ingrédient</button>
</div>