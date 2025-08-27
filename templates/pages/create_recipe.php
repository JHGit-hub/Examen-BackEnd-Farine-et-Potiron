<?php
/**
 * ============================================================
 *  Template : create_recipe.php
 *  Rôle :
 *      - Affiche le formulaire complet de création d'une recette.
 *      - Permet de choisir une farine, d'afficher ses détails, puis de compléter et enregistrer la recette.
 *
 *  Paramètres attendus :
 *      - $list_flours : tableau associatif contenant la liste des farines disponibles
 * ============================================================
 */

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create_recipe</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <div class="secondary_btn">
            <a href="index.php" class="close_btn logout_btn">
                <img src="../../../assets/icons/close.svg" alt="fermer la fenetre">
            </a>
        </div>
        <form class="form-filter">
            <label for="reference">Choisir une farine: </label>
            <select name="reference" id="reference">
                <option value="">Choisis ta farine</option>
                <?php foreach ($list_flours as $reference => $libelle): ?>
                    <option value="<?= htmlspecialchars($reference) ?>">
                        <?= htmlspecialchars($libelle) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="button" onclick="showDetailFlour(event, 'form_create_recipe','detail_flour')" class="secondary_btn">Voir détails</button>
        </form>
    </header>
    <main>
        <form method="post" action="save_new_recipe.php" class="hidden"  id="form_create_recipe">
            <div class="form" id="detail_flour"></div> <!-- frag_detail_flour -->
            <div class="form">
                <?php
                    include 'templates/fragments/form/frag_form_create_recipe.php';
                ?>
            </div>
            <div>
                <button type="submit" class="secondary_btn open_btn">Enregistrer</button>
            </div>
        </form>
        <div id="modal_background" class="modal_background hidden"></div>
    </main>
    <script src="js/functions.js" type="text/javascript"></script>
</body>

</html>