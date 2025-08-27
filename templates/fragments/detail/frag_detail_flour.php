<?php
/**
 * ============================================================
 *  Fragment : frag_detail_flour
 *  Rôle global :
 *      - Affiche les détails d'une farine sous forme de fiche.
 *      - Prépare le formulaire d'ajout de quantité pour une recette.
 *
 *  Paramètre attendu :
 *      - $detail_flour : tableau associatif contenant le détail de la farine issu de l’API.
 *
 * ============================================================
 */

?>

<div class="flour-card">
    <h2><?= htmlspecialchars($detail_flour["libelle"]) ?></h2>
    <p><strong>Nom de la farine :</strong> <?= htmlspecialchars($detail_flour["libelle"]) ?></p>
    <p><?= htmlspecialchars($detail_flour["description"]) ?></p>
</div>
<div>
    <input type="hidden" name="flour_reference" value="<?= htmlspecialchars($detail_flour["reference"]) ?>">
    <div>
        <label for="quantity">Quantité (en gr): </label>
        <input type="number" step="any" name="flour_quantity" placeholder="Quantité" required>
    </div>
</div>