<?php

/**
 * Frag_form_modif_recipe fragment
 *
 * Fragment de page pour afficher le formulaire de modification de recette
 *
 * Paramètres:
 *          - $detail_recipe: objet contenant les informations de la recette à modifier
 *          - $list_flours: tableau associatif contenant les types de farine disponibles
 *          - $flour_from_recipe: objet contenant les informations sur la farine utilisée dans la recette
 *          - $list_current_ingredients: tableau d'objet contenant les ingrédients enregistrés de la recette
 *
 */

?>
<div>
    <div class="secondary_btn">
        <a href="extract_detail_recipe.php?id=<?= $detail_recipe->id() ?>" class="close_btn logout_btn">
            <img src="../../../assets/icons/close.svg" alt="fermer la fenetre">
            <span>fermer</span>
        </a>
    </div>
</div>
<div>
    <form id="form_modif_recipe">
        <input type="hidden" name="id" value="<?= $detail_recipe->id() ?>">
        <select name="flour" id="flour">
            <option value="">Choisis ta farine</option>
            <?php foreach ($list_flours as $reference => $libelle): ?>
            <!-- on parcours le tableau des references, et si on trouve la reference de la farine de la recette on ajoute l'attribut selected -->
            <!-- cela affichera la reference de la farine utilisée dans la recette par defaut sur le select  -->
            <option 
                value="<?= htmlspecialchars($reference) ?>"
                <?= ($reference === $flour_from_recipe->get("reference")) ? "selected" : ""; ?>>
                <?= htmlspecialchars($libelle) ?>
            </option>
            <?php endforeach; ?>
        </select>
        <div>
            <div>
                <label for="quantity">Quantité (en gr): </label>
                <input type="number" step="any" name="flour_quantity" placeholder="Quantité" required value="<?= htmlspecialchars($flour_from_recipe->get("quantity")) ?>">
            </div>
        </div>
        <div>
            <div>
                <label for="title">Titre: </label>
                <input type="text" name="title" id="title" placeholder="Titre de la recette" required value="<?= htmlspecialchars($detail_recipe->get("title")) ?>">
            </div>
            <div>
                <label for="description">Description: </label>
                <textarea id="description" name="description" rows="5" cols="40" placeholder="Description de la recette" required><?= htmlspecialchars($detail_recipe->get("description")) ?></textarea>
            </div>
            <div>
                <label for="execution_time">Temps de préparation (en minutes): </label>
                <input type="number" id="execution_time" name="execution_time" required value="<?= htmlspecialchars($detail_recipe->get("execution_time")) ?>">
            </div>
            <div>
                <label for="difficulty">Difficulté: </label>
                <!-- on verifie la valeur de $detail_recipe->get("difficulty") dejà enregistrer pour cocher le bon radio par defaut -->
                <input type="radio" id="tres_facile" name="difficulty" value="très facile" required
                    <?= ($detail_recipe->get("difficulty") === "très facile") ? "checked" : "" ?>>
                <label for="tres_facile">Très facile</label>

                <input type="radio" id="facile" name="difficulty" value="facile"
                    <?= ($detail_recipe->get("difficulty") === "facile") ? "checked" : "" ?>> 
                <label for="facile">Facile</label>

                <input type="radio" id="difficile" name="difficulty" value="difficile"
                    <?= ($detail_recipe->get("difficulty") === "difficile") ? "checked" : "" ?>>
                <label for="difficile">Difficile</label>
            </div>
        </div>
        <div id="list_current_ingredients">
            <?php
                include 'templates/fragments/list/frag_list_current_ingredients.php';
            ?>
        </div>
        <div id="form_add_ingredient">
            <?php
                include 'templates/fragments/form/frag_form_add_ingredients.php';
            ?>
        </div>
        <div id="list_ingredients"></div> <!-- frag_list_ingredients.php -->

        <button type="button" class="secondary_btn open_btn" onclick="recordModifRecipe(event, 'modif_recipe', 'detail_recipe')">Enregistrer</button>
    </form>
</div>