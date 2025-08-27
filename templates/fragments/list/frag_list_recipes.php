<?php

/**
 * ============================================================
 *  Fragment : frag_list_recipes.php
 *  Rôle global :
 *      - Affiche la liste des recettes (toutes ou filtrées selon les critères).
 *
 *  Paramètre attendu :
 *      - $list_recipes : tableau d’objets contenant les recettes à afficher.
 *
 * ============================================================
 */

?>


<?php

    echo _model::createListFiltered($list_recipes, "extract_detail_recipe.php", "id", "title", "difficulty", false);
?>
