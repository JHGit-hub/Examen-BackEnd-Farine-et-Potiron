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
    <div>
        <label for="quantity">Quantité: </label>
        <input type="number" step="any" name="quantity" placeholder="Quantité">
    </div>
        <div>
        <label for="unit">Unité: </label>
        <input type="text" name="unit" placeholder="Unité">
    </div>
</div>