<?php

/**
 * Frag_form_create_user fragment
 *
 * Fragment de page pour afficher le formulaire de création de compte utilisateur
 *
 * Paramètres:
 *          - néant
 *
 */

?>

<div class="secondary_btn">
    <a href="index.php" class="logout_btn close_btn">
        <img src="../../../assets/icons/close.svg" alt="fermer la fenetre">
    </a>
</div>
<form class="form_create_user" method="post" action="save_new_user.php">
    <div class="create_field">
        <label for="surname">Pseudo: </label>
        <input type="text" name="surname" id="surname" value="" required>
    </div>
    <div class="create_field">
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" value="" required>
    </div>
    <div class="create_field">
        <label for="password">Mot de passe: </label>
        <input type="password" name="password" id="password" value="" required>
    </div>
    <div>
        <button type="submit" class="secondary_btn open_btn">Enregistrer</button>
    </div>
</form>