<?php
/**
 * ============================================================
 *  Fragment : frag_header_user_disconnected.php
 *  Rôle :
 *      - Affiche la navbar lorsque l'utilisateur n'est pas connecté
 *      - Bouton "Créer un compte" et formulaire de connexion (email ou pseudo)
 *
 *  Paramètres :
 *      - néant
 * ============================================================
 */

?>

<div class="header_login">
    <button onclick="showFormCreateUser('create_user')">Créer un compte</button>
    <form class="login_form" method="post" action="connect.php">
        <div class="login_field"> 
            <label for="login_mode">Se connecter avec :</label>
            <!-- le select permet de choisir entre email et pseudo -->
            <select id="login_mode" name="login_mode" onchange="toggleMode()"> <!-- la fonction toggleMode permet de changer le mode de connexion -->
                <option value="email">Email</option>
                <option value="username">Pseudo</option>
            </select>

            <label id="login_label" for="login_input">Email :</label> <!-- mode sur Email par defaut -->
            <!-- le texte du label, la valeur du input et son type sont modifiés dynamiquement grace à toggleMode() -->
            <input type="email" id="login_input" name="login_input" value="<?= htmlspecialchars($_POST["login_input"] ?? '') ?>" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" placeholder="Mot de Passe" required>            
        </div>
        <div>
            <input type="submit" class="primary_btn login_btn" value="Se connecter" title="se connecter">
        </div>
    </form>
</div>