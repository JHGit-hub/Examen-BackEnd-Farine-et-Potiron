<?php

/**
 * ============================================================
 *  Fragment : frag_form_modif_comment.php
 *  Rôle global :
 *      - Affiche le formulaire de modification d’un commentaire et/ou note.
 *      - Propose le bouton pour fermer le formulaire et revenir au détail de la recette.
 *      - Permet de modifier la note et le contenu du commentaire.
 *      - Propose les boutons pour enregistrer ou supprimer le commentaire.
 *
 *  Paramètre attendu :
 *      - $detail_comment : objet contenant les informations du commentaire et/ou note à modifier.
 *
 * ============================================================
 */
?>
<div class="close-modal">
    <a href="extract_detail_recipe.php?id=<?= $detail_comment->get("recipe_id")->id() ?>" class="close-btn">
        <img src="../assets/icons/close.svg" alt="fermer la fenetre">
    </a>
</div>
<form method="post" id="form_modif_comment">
    <input type="hidden" name="id" value="<?= $detail_comment->id() ?>">
    <div class="rate-comment">
        <label for="rate">Note (0 à 5)</label>
        <input type="number" name="rate" id="rate" min="0" max="5" step="1" value="<?= $detail_comment->get("rate") ?>" required>
    </div>
    <textarea name="content" rows="5" cols="40"><?= htmlspecialchars($detail_comment->get("content")) ?></textarea>
    <div class="footer-comment">
        <button type="button" onclick="recordModifComment(event, 'modif_comment', 'list_comments')" class="validate-btn">Enregistrer</button>
        <button type="button" onclick="deleteComment(event, <?= $detail_comment->id() ?>, 'modif_comment', 'list_comments')" class="delete-btn">Supprimer</button>
    </div>
</form>