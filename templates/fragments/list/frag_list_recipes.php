<?php

/**
 * Frag_list_recipes fragment
 *
 * Fragment de page pour afficher la liste des recettes (outes ou filtrées selon les critères choisis)
 *
 * Paramètres:
 *          - $list_recipes: tableau d'objet contenant les recettes à afficher
 *
 */

?>


<?php

    echo _model::createListFiltered($list_recipes, "extract_detail_recipe.php", "id", "title", "difficulty", false);
?>
