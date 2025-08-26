<?php

/**
 * Frag_detail_flour fragment
 *
 * Fragment de page pour afficher les détails d'une farine
 *
 * Paramètres:
 *          - $flour: tableau associatif du détail de la farine issu de l'API
 *
 */

?>

<div class="flour-card">
    <h2><?= htmlspecialchars($flour["libelle"]) ?></h2>
    <p><strong>Référence :</strong> <?= htmlspecialchars($flour["reference"]) ?></p>
    <p><?= htmlspecialchars($flour["description"]) ?></p>
</div>
<div>
    <input type="hidden" name="flour_reference" value="<?= htmlspecialchars($flour["reference"]) ?>">
    <div>
        <label for="quantity">Quantité (en gr): </label>
        <input type="number" step="any" name="flour_quantity" placeholder="Quantité" required>
    </div>
</div>