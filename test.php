<?php

echo '<pre>';
print_r($list_recipes);
echo 'ECHO AFFICHE ERREUR';
echo '</pre>';
?>

<?php
if ($session->isLogged() && $session->idConnected() !== $detail_recipe->get("user_id")->id()) {
    $hasCommented = false; // initialisation de la variable $hasCommented
    foreach ($list_comments as $comment) {
        if ($session->idConnected() === $comment->get("user_id")->id()) {
            // On affiche le bouton modifier son commentaire
            $hasCommented = true;
?>
            <button class="secondary_btn" onclick="showFormModifComment(<?= $comment->id() ?>, 'modif_comment')">Modifier le commentaire</button>
        <?php
        }
    }
    if (!$hasCommented) { // n'a pas commenté
        // On affiche un formulaire pour ajouter un commentaire
        ?>
        <form id="form_new_comment">
            <input type="hidden" name="recipe_id" value="<?= $detail_recipe->id() ?>">
            <label for="rate">Note (0 à 5)</label>
            <input type="number" name="rate" min="0" max="5" step="1" required>

            <textarea name="content" rows="5" cols="40" placeholder="Ajouter un commentaire"></textarea>
            <button type="button" onclick="recordNewComment(event, 'list_comments')" class="secondary_btn">Enregistrer</button>
        </form>
<?php
    }
}
?>




<!-- SAV frag_form_create_comment.php -->
<form id="form_new_comment">
    <input type="hidden" name="recipe_id" value="<?= $detail_recipe->id() ?>">
    <label for="rate">Note (0 à 5)</label>
    <input type="number" name="rate" min="0" max="5" step="1" required>

    <textarea name="content" rows="5" cols="40" placeholder="Ajouter un commentaire"></textarea>
    <button type="button" onclick="recordNewComment(event, 'list_comments')" class="secondary_btn">Enregistrer</button>
</form>


<!-- SAV recipe_page.php -->
        <?php
        if ($session->isLogged() && $session->idConnected() !== $detail_recipe->get("user_id")->id()) {
            $hasCommented = false; // initialisation de la variable $hasCommented
            foreach ($list_comments as $comment) {
                if ($session->idConnected() === $comment->get("user_id")->id()) {
                    // On affiche le bouton modifier son commentaire
                    $hasCommented = true;
        ?>
                    <button class="secondary_btn" onclick="showFormModifComment(<?= $comment->id() ?>, 'modif_comment')">Modifier le commentaire</button>
                <?php
                }
            }
            if (!$hasCommented) { // n'a pas commenté
                // On affiche un formulaire pour ajouter un commentaire
                ?>
                <?php include 'templates/fragments/form/frag_form_create_comment.php'; ?>
        <?php
            }
        }
        ?>