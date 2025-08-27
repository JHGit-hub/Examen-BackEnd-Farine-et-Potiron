<?php

/**
 * Frag_form_modif_profil fragment
 *
 * Fragment de page pour afficher le formulaire de modification de profil utilisateur
 *
 * Paramètres:
 *          - $user: objet contenant les informations de l'utilisateur connecté
 *
 */


?>

<div class="secondary_btn">
    <a href="init_user_page.php" class="close_btn logout_btn">
        <img src="../../../assets/icons/close.svg" alt="fermer la fenetre">
    </a>
</div>
<div>
    <form method="post" id="form_modif_profil">
        <div class="edit_profil">
            <div class="profil_txt">
                <div class="edit_profil_txt">
                    <label for="username">Nom: </label>
                        <input type="text" name="username" id="username" value="<?= htmlspecialchars($user->get("username")) ?>">
                </div>
                <div class="edit_profil_txt">
                    <label for="email">Email: </label>
                        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user->get("email")) ?>">
                </div>
                <div class="edit_profil_txt">
                    <button type="button" onclick="showPassword()">Modifier le mot de passe</button>
                    <div id="modifPassword" style="display: none;">
                        <label for="password">Nouveau mot de passe :
                            <input type="password" name="password" id="password" value="">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="button_profil">
            <button type="button" class="secondary_btn open_btn"onclick="recordModifProfil(event, 'modif_profil', 'edit_profil')">
                <img src="../../../assets/icons/validate_modif_profil.svg" alt="valider modification de profil">
                <span>Enregistrer les modifications</span>
            </button>
        </div>
    </form>
</div>