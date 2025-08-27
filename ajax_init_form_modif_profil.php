<?php

/**
 * ============================================================
 *  Contrôleur : ajax_init_form_modif_profil.php
 *  Rôle :
 *      - Prépare le formulaire de modification du profil utilisateur.
 *
 *  Paramètre attendu :
 *      - néant
 *
 *  Retourne :
 *      - $user : objet contenant les informations de l’utilisateur connecté.
 *      - Fragment HTML généré par 'frag_form_modif_profil.php'.
 * ============================================================
 */

////// Initialisation:
include_once "library/init.php";

////// Contrôle de session utilisateur:
if (!$session->isLogged()) {
    // L'utilisateur N'EST PAS connecté
    header('Location: index.php');
    exit();
}

////// Traitement:
// On récupére l'id de l'utilisateur
$id = $session->idConnected();

// On instancie et charge la classe User
$user = new User($id);


////// Affichage de la page:
include "templates/fragments/form/frag_form_modif_profil.php";