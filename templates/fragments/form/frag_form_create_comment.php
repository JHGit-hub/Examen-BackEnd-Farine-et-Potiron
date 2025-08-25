<?php

/**
 * Frag_form_create_comment fragment
 *
 * Fragment de page pour afficher le formulaire de création de commentaire et/ou note
 *
 * Paramètres:
 *          - $id: id de la recette
 *
 */

?>

<form id="form_new_comment">
    <input type="hidden" name="recipe_id" value="<?= $detail_recipe->id() ?>">
    <label for="rate">Note (0 à 5)</label>
    <input type="number" name="rate" min="0" max="5" step="1" required>

    <textarea name="comment" rows="5" cols="40" placeholder="Ajouter un commentaire"></textarea>
    <button type="button" onclick="recordNewComment(event, 'list_comments')" class="secondary_btn">Enregistrer</button>
</form>