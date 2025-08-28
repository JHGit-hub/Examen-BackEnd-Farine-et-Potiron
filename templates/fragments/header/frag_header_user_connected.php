<?php

/**
 * ============================================================
 *  Fragment : frag_header_user_connected.php
 *  Rôle :
 *      - Affiche la navbar lorsque l'utilisateur est connecté
 *      - Accès au compte et bouton déconnexion
 *
 *  Paramètres :
 *      - $user : objet User de l'utilisateur connecté
 * ============================================================
 */

?>

<div class="header-login">
    <div class="header-profil">
        <a href="init_user_page.php" title="Accéder à mon compte">
            <?= $user->get("username") ?>
            <img src="../assets/images/user_profil.svg" alt="Image du profil par défaut">
        </a>
    </div>
    <div class="logout-btn">
        <a href="disconnect.php" title="se déconnecter de la session">
            <img src="../assets/icons/logout.svg" alt="Se déconnecter">
        </a>
    </div>
</div>
<!--
<div class="banner-title">
    <img src="../assets/images/title.png" alt="Titre du site">
</div>
-->
