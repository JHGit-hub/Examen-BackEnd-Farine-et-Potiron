<?php

/**
 * ============================================================
 *  Fragment : frag_form_add_ingredients.php
 *  Rôle :
 *      - Affiche le formulaire pour ajouter un ingrédient à la recette
 *
 *  Paramètres :
 *      - néant
 * ============================================================
 */

?>

<div id="form_add_ingredient">
    <div class="add-ingredient-detail">
        <div class="add-ingredient-label">
            <label for="reference">Nom : </label>
            <input type="text" name="reference" id="reference" placeholder="Nom de l'ingrédient" required>
        </div>
        <div class="add-ingredient-label">
            <label for="quantity">Quantité : </label>
            <input type="number" step="any" name="quantity" id="quantity" placeholder="Quantité" required>
        </div>
        <div class="add-ingredient-label">
            <label for="unit">Unité : </label>
            <input type="text" name="unit" id="unit" placeholder="Unité" required>
        </div>
    </div>
    <div class="footer-add-ingredient">
        <button type="button" onclick="addIngredient(event, 'list_ingredients')" class="add-ingredient-btn">Ajouter l'ingrédient</button>
</div>