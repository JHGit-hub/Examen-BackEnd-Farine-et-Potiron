<?php
/**
 * ============================================================
 *  Classe : User
 *  Rôle global :
 *      - Modélise les utilisateurs de l’application.
 *      - Fournit des méthodes pour valider la connexion (login) et récupérer l’utilisateur actuellement connecté.
 *      - Hérite des méthodes de _model pour la gestion CRUD des utilisateurs.
 *
 *  Principales méthodes :
 *      1. validateLogin($password, $login_mode_name, $login_mode_value) : Valide les identifiants et retourne l’objet User si connexion réussie.
 *      2. getCurrentUser() : Récupère l’objet utilisateur actuellement connecté (via la session).
 *
 *  Convention :
 *      - Les champs protégés correspondent aux colonnes de la table 'users'.
 *      - La validation du mot de passe utilise password_verify pour gérer les mots de passe hashés.
 *
 * ============================================================
 */

class User extends _model
{

    protected $table = 'users'; // nom de la table dans la bdd

    protected $champs = ["username", "email", "password"]; // liste des champs dans la table (sans id)

    protected $username; // le nom d'utilisateur
    protected $email; // l'email de l'utilisateur
    protected $password; // le mot de passe de l'utilisateur

    //// 1. Valider les identifiants
    public static function validateLogin(string $password, string $login_mode_name, string $login_mode_value)
    {
        // rôle : 
        //      - valider la connection en verifiant la combinaison email et password
        // paramètres: 
        //      - $password: mot de passe entré dans le formulaire par method POST
        //      - $login_mode_name: mode connexion choisi (pseudo ou email)
        //      - $login_mode_value: valeur du mode de connexion (pseudo ou email)
        // retour : 
        //      -objet User si connexion réussie, false sinon

        // Chargement des informations de l'utilisateur selon le mode de connexion choisi
        $user = new User();
        if ($login_mode_name === "email") {
            $user->loadFromField("email", $login_mode_value);
        } else {
            $user->loadFromField("username", $login_mode_value);
        }

        // On verifie qu'il existe
        if (!$user->is()) {
            return false;
        }

        /*
        // cas avec mot de passe non hashé
        // On verifie la concordance avec le mot de passe
        if($password === $user->get("password")){ // si oui on renvoi $user
            return $user;
        } else {
            return false;
        }
        */

        
        // cas avec mot de passe hashé
        // On récupére le mot de passe hashé
        $password_hashed = $user->get("password");

        // On verifie la concordance avec le mot de passe
        if (password_verify($password, $password_hashed)) {
            return $user;
        } else {
            return false;
        }
        

    }

    //// 2. Extraire l’objet utilisateur actuellement connecté
    public static function getCurrentUser()
    {
        // Rôle : Récupérer l'utlisateur connecté
        // Paramètres  : 
        //              néant
        // Retour : $user: objet utilisateur, chargé avec l'utilisateur connecté, ou non chargé

        global $session;

        $user = new User();
        if ($session->isLogged()) {
            $user->loadFromId($session->idConnected());
        }

        return $user;
    }
}
