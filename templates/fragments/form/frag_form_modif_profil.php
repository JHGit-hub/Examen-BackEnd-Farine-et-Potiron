<?php

/**
 * ============================================================
 *  Fragment : frag_form_modif_profil.php
 *  Rôle global :
 *      - Affiche le formulaire de modification du profil utilisateur.
 *      - Permet de modifier le nom, l’email et le mot de passe.
 *      - Propose un bouton pour enregistrer les modifications et un bouton pour fermer le formulaire.
 *
 *  Paramètre attendu :
 *      - $user : objet contenant les informations de l’utilisateur connecté.
 *
 * ============================================================
 */

?>
<div class="edit-profil">
    <div class="close-modal">
        <a href="init_user_page.php" class="close-btn">
            <img src="../assets/icons/close.svg" alt="fermer la fenetre">
        </a>
    </div>
    <form class="form-modif-user" method="post" id="form_modif_profil">
        <div class="edit-profil-txt">
            <label for="username">Nom: </label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($user->get("username")) ?>">
        </div>
        <div class="edit-profil-txt">
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($user->get("email")) ?>">
        </div>
        <div class="edit-profil-password">
            <button class="password-btn" type="button" onclick="showPassword()">Modifier le mot de passe</button>
            <div id="modif_password" style="display: none;">
                <label for="password">Nouveau mot de passe :
                    <input type="password" name="password" id="password" value="">
                </label>
            </div>
        </div>
        <div  class="footer-modal">
            <button type="button" class="validate-btn"onclick="recordModifProfil(event, 'modif_profil', 'edit_profil')">
                <span>Enregistrer</span>
            </button>
        </div>
    </form>
</div>