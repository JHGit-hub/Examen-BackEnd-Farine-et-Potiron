<?php

/**
 * ============================================================
 *  Template : homepage.php
 *  Rôle :
 *      - Affiche la page d'accueil avec header selon l'état de connexion
 *      - Affiche la liste des recettes avec système de filtrage par farine(s) et difficulté
 *
 *  Paramètres attendus :
 *      - $list_recipes : liste des recettes à afficher (toutes ou filtrées)
 *      - $list_flours : tableau associatif avec références et libellés des farines
 * ============================================================
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
        <?php
            // Affichage d'un message d'erreur si erreur de connexion
            if (isset($_SESSION['error_msg'])) { ?>
                <div class="error-msg">
                    <?= htmlspecialchars($_SESSION['error_msg']) ?>
                </div>
                <?php
                unset($_SESSION['error_msg']);
            }
        ?>
        <div class="modal hidden" id="create_user"></div> <!-- frag_form_create_user -->
        <form class="form_filter">
            <div class="select_filter">
                <label for="flour_1">Choisir une farine: </label>
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
                <label for="flour_2">Choisir une deuxiéme farine: </label>
                <select name="flour_2" id="flour_2"> <!-- on donne l'identifiant unique à chaque select, ici flour_2 -->
                    <option value="">Choisis ta farine</option>
                    <?php foreach ($list_flours as $reference => $libelle): ?>
                        <option value="<?= htmlspecialchars($reference) ?>">
                            <?= htmlspecialchars($libelle) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="difficulty">Choisir la difficulté: </label>
                <?php
                echo _model::createSelect($list_recipes, "difficulty", "difficulty", "Niveau de difficultés");
                ?>
            </div>
            <button type="button" onclick="filterRecipes(event, 'list_recipes')" class="secondary_btn">Filtrer</button>
        </form>
        <div>
            <h2>Liste des recettes: </h2>
            <div id="list_recipes" class="list_recipes">
                <?php
                echo _model::createListFiltered($list_recipes, "extract_detail_recipe.php", "id", "title", "difficulty", false);
                ?>
            </div>
        </div>
        <div id="modal_background" class="modal_background hidden"></div>
    </main>
    <script src="js/functions.js" type="text/javascript"></script>
</body>

</html>