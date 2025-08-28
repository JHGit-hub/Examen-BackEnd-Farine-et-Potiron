<?php

/**
 * ============================================================
 *  Fragment : frag_form_create_user.php
 *  Rôle global :
 *      - Affiche le formulaire de création de compte utilisateur.
 *      - Propose un bouton pour fermer le formulaire.
 *      - Utilise un champ "honeypot" caché pour limiter les soumissions automatiques par des bots.
 *
 *  Paramètres attendus :
 *      - néant
 *
 * ============================================================
 */

?>
<div class="create-user">
    <div class="close-modal">
        <a href="index.php" class="close-btn">
            <img src="../assets/icons/close.svg" alt="fermer la fenetre">
        </a>
    </div>
    <form class="form-create_user" method="post" action="save_new_user.php">
        <!-- utilisation d'un 'honeypot' pour éviter les soumissions de bots -->
        <!-- ajout d'un champ caché "website" que les bots remplissent -->
        <input type="text" name="website" style="display:none">
        <div class="create-field">
            <label for="username">Pseudo: </label>
            <input type="text" name="username" id="username" value="" required>
        </div>
        <div class="create-field">
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" value="" required>
        </div>
        <div class="create-field">
            <label for="password">Mot de passe: </label>
            <input type="password" name="password" id="password" value="" required>
        </div>
        <div class="footer-modal">
            <button type="submit" class="validate-btn">Enregistrer</button>
        </div>
    </form>
</div>