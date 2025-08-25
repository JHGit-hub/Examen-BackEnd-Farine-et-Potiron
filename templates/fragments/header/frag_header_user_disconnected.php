<?php

/**
 * Frag_header_user_disconnected fragment
 *
 * Fragment de page pour afficher la navbar lorsque l'utilisateur n'est pas connecté
 * avec un bouton connexion ou création de compte
 *
 * Paramètres:
 *          - néant
 *
 */

?>

<div class="header_login">
    <button onclick="showFormCreateUser('create_user')">Créer un compte</button>
    <form class="login_form" method="post" action="connect.php">
        <div class="login_field"> <!-- mettre une checkbox pour choisir entre email et pseudo -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Entrez votre Email"  value="<?= htmlspecialchars($_POST["email"] ?? '') ?>">
            <label for="password">Mot de Passe:</label>
            <input type="password" id="password" name="password" placeholder="Mot de Passe" required>            
        </div>
        <div>
            <input type="submit" class="primary_btn login_btn" value="Se connecter" title="se connecter">
        </div>
    </form>
</div>