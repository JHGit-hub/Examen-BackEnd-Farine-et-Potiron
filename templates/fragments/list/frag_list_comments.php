<?php

/**
 * ============================================================
 *  Fragment : frag_list_comments
 *  Rôle global :
 *      - Affiche la liste des commentaires et/ou notes.
 *      - Affiche, pour chaque commentaire : auteur, date (création ou mise à jour), note et contenu.
 *      - Ajoute le fragment du formulaire de création de commentaire à la fin.
 *
 *  Paramètre attendu :
 *      - $list_comments : tableau d’objets contenant les commentaires et/ou notes à afficher.
 *
 * ============================================================
 */

?>

<?php

foreach ($list_comments as $comment) {
?>
    <div class="comment">
        <div class="comment-header">
            <div> 
                <span class="comment-author"><?= $comment->get("user_id")->get("username") ?></span> 
                <span class="comment-date">
                    <?php
                        if ($comment->get("update_date")) {
                            $newDate = substr($comment->get("update_date"), 0, 10);
                            $formattedDate = date("d/m/Y", strtotime($newDate));
                            echo "mise à jour le: " . $formattedDate;
                        } else {
                            $newDate = substr($comment->get("creation_date"), 0, 10);
                            $formattedDate = date("d/m/Y", strtotime($newDate));
                            echo "créée le: " . $formattedDate;
                        }
                    ?>
                </span>
            </div>
            <div>
                <p>Note: <?= $comment->get("rate") ?></p>
            </div>
        </div>
        <div class="comment-body">
            <p><?= $comment->get("content") ?></p>
        </div>
    </div>
<?php
}
include 'templates/fragments/form/frag_form_create_comment.php';
?>