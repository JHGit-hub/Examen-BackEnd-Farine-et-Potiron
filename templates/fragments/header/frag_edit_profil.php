<?php

/**
 * ============================================================
 *  Fragment : frag_edit_profil.php
 *  Rôle global :
 *      - Affiche le détail du profil utilisateur connecté.
 *      - Affiche le pseudo et l’email.
 *      - Propose un bouton pour ouvrir le formulaire de modification du profil.
 *
 *  Paramètre attendu :
 *      - $user : objet contenant les informations de l’utilisateur connecté
 * ============================================================
 */

?>
<a href="index.php" class="secondary-btn">accueil</a>
<div class="detail-profil">
    <div class="button-profil">
        <button type="button" class="secondary-btn" onclick="showFormModifProfil('modif_profil')">
            <p>Modifier le profil</p>
            <img src="../../../assets/icons/modif_user.svg" alt="modifier le profil">
        </button>
    </div>
    <a href="extract_list_flours.php" class="secondary-btn">nouvelle recette
        <img src="../../../assets/icons/add_recipe.svg" alt="Créer une nouvelle recette">
    </a>
</div>