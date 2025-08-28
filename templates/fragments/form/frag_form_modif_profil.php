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

<div class="secondary-btn">
    <a href="init_user_page.php" class="close-btn logout-btn">
        <img src="../../../assets/icons/close.svg" alt="fermer la fenetre">
    </a>
</div>
<div>
    <form method="post" id="form_modif_profil">
        <div class="edit-profil">
            <div class="profil-txt">
                <div class="edit-profil-txt">
                    <label for="username">Nom: </label>
                        <input type="text" name="username" id="username" value="<?= htmlspecialchars($user->get("username")) ?>">
                </div>
                <div class="edit-profil-txt">
                    <label for="email">Email: </label>
                        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user->get("email")) ?>">
                </div>
                <div class="edit-profil-txt">
                    <button type="button" onclick="showPassword()">Modifier le mot de passe</button>
                    <div id="modifPassword" style="display: none;">
                        <label for="password">Nouveau mot de passe :
                            <input type="password" name="password" id="password" value="">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-profil">
            <button type="button" class="secondary-btn open-btn"onclick="recordModifProfil(event, 'modif_profil', 'edit_profil')">
                <img src="../../../assets/icons/validate_modif_profil.svg" alt="valider modification de profil">
                <span>Enregistrer les modifications</span>
            </button>
        </div>
    </form>
</div>