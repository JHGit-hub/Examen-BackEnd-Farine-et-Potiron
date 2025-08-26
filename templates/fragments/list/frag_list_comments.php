<?php

/**
 * Frag_list_comments fragment
 *
 * Fragment de page pour afficher la liste des commentaires et/ou notes
 *
 * Paramètres:
 *          - $list_comments: tableau d'objet contenant les commentaires et/ou notes à afficher
 *
 */

?>

<?php

foreach ($list_comments as $comment) {
?>
    <div class="comment">
        <div class="comment_header">
            <div> 
                <span class="comment_author"><?= $comment->get("user_id")->get("username") ?></span> 
                <span class="comment_date">
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
        <div class="comment_body">
            <p><?= $comment->get("content") ?></p>
        </div>
    </div>
<?php
}
include 'templates/fragments/form/frag_form_create_comment.php';
?>