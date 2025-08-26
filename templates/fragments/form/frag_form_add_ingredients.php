<?php

/**
 * Frag_form_add_ingredients fragment
 *
 * Fragment de page pour afficher le formulaire de création et d'ajout d'un ingrédient à la recette
 *
 * Paramètres:
 *          - néant
 *
 */

?>

<div id="form_add_ingredient">
    <label for="reference">Nom de l'ingrédient: </label>
    <input type="text" name="reference" id="reference" placeholder="Nom de l'ingrédient" required>

    <label for="quantity">Quantité: </label>
    <input type="number" step="any" name="quantity" id="quantity" placeholder="Quantité" required>

    <label for="unit">Unité: </label>
    <input type="text" name="unit" id="unit"placeholder="Unité" required>

    <button type="button" onclick="addIngredient(event, 'list_ingredients')" class="secondary_btn">Ajouter l'ingrédient</button>
</div>