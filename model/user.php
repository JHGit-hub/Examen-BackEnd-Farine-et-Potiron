<?php

class User extends _model
{

    protected $table = 'users'; // nom de la table dans la bdd

    protected $champs = ["username", "email", "password"]; // liste des champs dans la table (sans id)

    protected $username; // le nom d'utilisateur
    protected $email; // l'email de l'utilisateur
    protected $password; // le mot de passe de l'utilisateur

    //// 1. Valider les identifiants
    public static function validateLogin(string $email, string $password)
    {
        // rôle : valider la connection en verifiant la combinaison email et password
        // paramètres: 
        //             $password: mot de passe entré dans le formulaire par method POST
        //             $email: email entré dans le formulaire par method POST
        // retour : objet User si connexion réussie, false sinon

        // Chargement des informations de l'utilisateur dont on a l'email
        $user = new User();
        $user->loadFromField("email", $email);

        // On verifie qu'il existe
        if (!$user->is()) {
            return false;
        }

         
        // cas avec mot de passe non hashé
        // On verifie la concordance avec le mot de passe
        if($password === $user->get("password")){ // si oui on renvoi $user
            return $user;
        } else {
            return false;
        }
        

        /*
        // On récupére le mot de passe hashé
        $password_hashed = $user->get("password");

        // On verifie la concordance avec le mot de passe
        if (password_verify($password, $password_hashed)) {
            return $user;
        } else {
            return false;
        }
        */

    }

    //// 2. Récupèrer l’objet utilisateur actuellement connecté
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
