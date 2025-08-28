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
 *      - $user : objet de l'utilisateur connecté
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
        <div class="banner-title">
            <img src="../assets/images/title.png" alt="Titre du site">
        </div>
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
        <div class="banner">
            <h1>Bienvenue sur Farine & Potiron</h1>
            <h2>Nous sommes passionnés par les farines spéciales et leur incroyable richesse en cuisine</h2>
        </div>
        <div class="modal hidden" id="create_user"></div> <!-- frag_form_create_user -->
        <form class="form-filter">
            <div class="select-filter">
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
            <div class="filter-btn">
                <button type="button" onclick="filterRecipes(event, 'list_recipes')" class="validate-btn">Filtrer</button>
            </div>
        </form>
        <div class="list-container">
            <h2>Liste des recettes: </h2>
            <div id="list_recipes" class="list-recipes">
            <?php foreach($list_recipes as $recipe): ?>
                <a href = "extract_detail_recipe.php?id=<?= $recipe->id(); ?>">
                    <div class='card-recipe'>
                        <div class='card-img'>
                            <img src="assets/images/recipe_default.png" alt="image de recette par defaut">
                        </div>
                        <div class='card-content'>
                            <h3 class="card-title"><?= htmlspecialchars($recipe->get('title')); ?></h3>
                            <p class="card-author"><strong>Créée par : </strong><?= htmlspecialchars($recipe->get('user_id')->get("username")); ?></p>
                            <p class="card-date">
                                <?php
                                if ($recipe->get("update_date")) {
                                    $newDate = substr($recipe->get("update_date"), 0, 10);
                                    $formattedDate = date("d/m/Y", strtotime($newDate));
                                    echo "mise à jour le : " . $formattedDate;
                                } else {
                                    $newDate = substr($recipe->get("creation_date"), 0, 10);
                                    $formattedDate = date("d/m/Y", strtotime($newDate));
                                    echo "créée le : " . $formattedDate;
                                }
                                ?>
                            </span>
                            <p class="card-difficulty">Difficulté: <?= htmlspecialchars($recipe->get('difficulty')); ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
            </div>
        </div>
        <div id="modal_background" class="modal_background hidden"></div>
    </main>
    <script src="js/functions.js" type="text/javascript"></script>
</body>

</html>