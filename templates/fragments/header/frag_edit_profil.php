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
<div class="secondary_btn">
    <a href="index.php" class="close_btn logout_btn">
        <img src="../../../assets/icons/close.svg" alt="fermer la fenetre">
    </a>
</div>
<div>
    <div class="edit_profil">
        <div class="profil_txt">
            <div class="edit_profil_txt">
                <strong>Pseudo: </strong>
                <p><?= htmlspecialchars($user->get("username")) ?></p>
            </div>
            <div class="edit_profil_txt">
                <strong>Email: </strong>
                <p><?= htmlspecialchars($user->get("email")) ?></p>
            </div>
        </div>
    </div>
    <div class="button_profil">
        <button type="button" class="secondary_btn open_btn" onclick="showFormModifProfil('modif_profil')">
            <img src="../../../assets/icons/modif_profil.svg" alt="modifier le profil">
            <span>Modifier le profil</span>
        </button>
    </div>
</div>