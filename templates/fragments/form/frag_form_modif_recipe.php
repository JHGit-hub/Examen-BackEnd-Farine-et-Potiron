<?php

/**
 * Frag_form_modif_recipe fragment
 *
 * Fragment de page pour afficher le formulaire de modification de recette
 *
 * Paramètres:
 *          - $detail_recipe: objet contenant les informations de la recette à modifier
 *          - $list_flours: tableau associatif contenant les types de farine disponibles
 *          - $flour: objet contenant les informations sur la farine utilisée dans la recette
 *
 */

?>
<div>
    <div class="secondary_btn">
        <a href="extract_detail_recipe.php?id=<?= $detail_recipe->id() ?>" class="close_btn logout_btn">
            <img src="../../../assets/icons/close.svg" alt="fermer la fenetre">
        </a>
    </div>
</div>
<div>
    <form id="form_modif_recipe">
        <input type="hidden" name="id" value="<?= $detail_recipe->id() ?>">
        <select name="flour" id="flour">
            <option value="">Choisis ta farine</option>
            <?php foreach ($list_flours as $reference => $libelle): ?>
                <option value="<?= htmlspecialchars($reference) ?>">
                    <?= htmlspecialchars($libelle) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div>
            <div>
                <label for="quantity">Quantité: </label>
                <input type="number" step="any" name="flour_quantity" placeholder="Quantité" required value="<?= htmlspecialchars($flour->get("flour_quantity")) ?>">
            </div>
            <div>
                <label for="unit">Unité: </label>
                <input type="text" name="flour_unit" placeholder="Unité" required value="<?= htmlspecialchars($flour->get("flour_unit")) ?>">
            </div>
        </div>
        <div>
            <div>
                <label for="title">Titre: </label>
                <input type="text" name="title" id="title" placeholder="Titre de la recette" required value="<?= htmlspecialchars($detail_recipe->title()) ?>">
            </div>
            <div>
                <label for="description">Description: </label>
                <textarea id="description" name="description" rows="5" cols="40" placeholder="Description de la recette" required><?= htmlspecialchars($detail_recipe->description()) ?></textarea>
            </div>
            <div>
                <label for="execution_time">Temps de préparation (en minutes): </label>
                <input type="number" id="execution_time" name="execution_time" required value="<?= htmlspecialchars($detail_recipe->execution_time()) ?>">
            </div>
            <div>
                <label for="difficulty">Difficulté: </label>

                <input type="radio" id="tres_facile" name="difficulty" value="très facile" required>
                <label for="tres_facile">Très facile</label>

                <input type="radio" id="facile" name="difficulty" value="facile">
                <label for="facile">Facile</label>

                <input type="radio" id="difficile" name="difficulty" value="difficile">
                <label for="difficile">Difficile</label>
            </div>
        </div>
        <div id="list_current_ingredients"></div> <!-- frag_list_current_ingredients.php -->
        <div id="form_add_ingredient"></div> <!-- frag_form_add_ingredient.php -->
        <div id="list_ingredients"></div> <!-- frag_list_ingredients.php -->

        <button type="button" class="secondary_btn open_btn" onclick="recordModifRecipe(event, 'modif_recipe', 'detail_recipe')">Enregistrer</button>
    </form>
</div>