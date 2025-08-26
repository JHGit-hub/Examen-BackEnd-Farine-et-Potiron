<?php

/**
 * Frag_form_modif_comment fragment
 *
 * Fragment de page pour afficher le formulaire de modification de commentaire et/ou note
 *
 * Paramètres:
 *          - $detail_comment: objet contenant les informations du commentaire et/ou note à modifier
 *
 */
?>

<form method="post" id="form_modif_comment">
    <input type="hidden" name="id" value="<?= $detail_comment->id() ?>">

    <label for="rate">Note (0 à 5)</label>
    <input type="number" name="rate" min="0" max="5" step="1" value="<?= $detail_comment->get("rate") ?>" required>

    <textarea name="content" rows="5" cols="40"><?= htmlspecialchars($detail_comment->get("content")) ?></textarea>
    <div>
        <button type="button" onclick="recordModifComment(event, 'modif_comment', 'list_comments')" class="secondary_btn">Enregistrer</button>
        <button type="button" onclick="deleteComment(event, <?= $detail_comment->id() ?>, 'modif_comment', 'list_comments')" class="delete_btn">Supprimer</button>
    </div>
</form>