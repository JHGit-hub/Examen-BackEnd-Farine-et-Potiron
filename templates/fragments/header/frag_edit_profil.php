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
<div class="secondary-btn">
    <a href="index.php" class="close-btn logout-btn">
        <img src="../../../assets/icons/close.svg" alt="fermer la fenetre">
    </a>
</div>
<div>
    <div class="edit-profil">
        <div class="profil-txt">
            <div class="edit-profil-txt">
                <strong>Pseudo: </strong>
                <p><?= htmlspecialchars($user->get("username")) ?></p>
            </div>
            <div class="edit-profil-txt">
                <strong>Email: </strong>
                <p><?= htmlspecialchars($user->get("email")) ?></p>
            </div>
        </div>
    </div>
    <div class="button-profil">
        <button type="button" class="secondary-btn open-btn" onclick="showFormModifProfil('modif_profil')">
            <img src="../../../assets/icons/modif_profil.svg" alt="modifier le profil">
            <span>Modifier le profil</span>
        </button>
    </div>
</div>