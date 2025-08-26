<?php

/**
 * Homepage template
 * 
 * Template de page compléte dans lequel on affichera un header selon si l'utilisateur est connecté ou non
 * Affichage de la liste des recettes et d'un systéme de filtrage selon farine et difficulté
 * 
 * Paramètres:
 *          - $list_recipes: liste des recettes à afficher; toutes ou filtrés selon critères
 * 
 */

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <?php
        if ($session->isLogged()) {
            // - si utilisateur connecté, on affiche le fragment frag_header_user_connected.php
            include 'templates/fragments/header/frag_header_user_connected.php';
        } else {
            // - si utilisateur n'est pas connecté, on affiche le fragment frag_header_user_disconnected.php
            include 'templates/fragments/header/frag_header_user_disconnected.php';
        }
        ?>
    </header>
    <main>
        <div class="modal hidden" id="create_user"></div> <!-- frag_form_create_user -->
        <form class="form_filter">
            <div class="select_filter">
                <label for="reference">Choisir une farine: </label>
                <select name="flour_1" id="flour_1"> <!-- on donne l'identifiant unique à chaque select, ici flour_1 -->
                    <option value="">Choisis ta farine</option>
                    <?php foreach ($list_flours as $reference => $libelle): ?>
                        <!-- on parcours le tableau associatif list_flours -->
                        <!-- $reference est la clé du tableau, $libelle la valeur associée -->
                        <!-- pour chaque elements du tableau on crée une balise option -->
                        <option value="<?= htmlspecialchars($reference) ?>">
                        <!-- la valeur transmise est la reference -->
                            <?= htmlspecialchars($libelle) ?>
                            <!-- ce qui est afficher est le libelle -->
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="reference">Choisir une deuxiéme farine: </label>
                <select name="flour_2" id="flour_2"> <!-- on donne l'identifiant unique à chaque select, ici flour_2 -->
                    <option value="">Choisis ta farine</option>
                    <?php foreach ($list_flours as $reference => $libelle): ?>
                        <option value="<?= htmlspecialchars($reference) ?>">
                            <?= htmlspecialchars($libelle) ?>
                        </option>
                    <?php endforeach; ?>
                </select name="difficulty" id="difficulty">
                <label for="difficulty">Choisir la difficulté: </label>
                <?php
                echo _model::createSelect($list_recipes, "difficulty", "difficulty", "Niveau de difficultés");
                ?>
            </div>
            <button type="button" onclick="filterRecipes(event, 'list_recipes')" class="secondary_btn">Filtrer</button>
        </form>
        <div>
            <h2>Liste des recettes: </h2>
            <div id="list_recipes" class="list_recipe">
                <?php
                echo _model::createListFiltered($list_recipes, "extract_detail_recipe.php", "id", "title", "difficulty", false);
                ?>
            </div>
        </div>
    </main>
    <script src="js/functions.js" type="text/javascript"></script>
</body>

</html>