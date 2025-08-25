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
                    <?php // si on a une date de mise a jour, on l'affiche
                        if($comment->get("update_date")){
                            echo $comment->get("update_date");
                        }else{
                            echo $comment->get("date");
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

?>