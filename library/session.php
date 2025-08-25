<?php

/**
 * ============================================================
 *  Classe : Session
 *  Rôle global :
 *      - Gère la session PHP et l’authentification utilisateur.
 *      - Centralise les méthodes courantes pour manipuler la session (connexion, déconnexion, lecture/écriture de variables).
 *
 *  Méthodes principales :
 *      1. __construct()
 *          - Démarre automatiquement la session PHP si elle n’est pas déjà active.
 *
 *      2. logged($id)
 *          - Déclare qu’un utilisateur est connecté (stocke son id en session).
 *          - Retourne true.
 *
 *      3. logOut()
 *          - Déconnecte l’utilisateur (supprime l’id de la session).
 *          - Retourne true.
 *
 *      4. isLogged()
 *          - Indique si un utilisateur est actuellement connecté.
 *          - Retourne true ou false.
 *
 *      5. idConnected()
 *          - Retourne l’id de l’utilisateur connecté, ou 0 si personne n’est connecté.
 *
 *      6. get($key)
 *          - Récupère la valeur associée à une clé dans la session.
 *          - Retourne la valeur ou null si la clé n’existe pas.
 *
 *      7. set($key, $value)
 *          - Définit ou modifie une valeur pour une clé dans la session.
 *
 *  Convention :
 *      - L’id utilisateur est stocké sous la clé 'id' en session.
 *      - Les valeurs de session sont toujours accessibles via get/set.
 *      - Le constructeur démarre la session automatiquement.
 *
 *  Exemple d’utilisation :
 *      $session = new Session();
 *      if ($session->isLogged()) {
 *          $id = $session->idConnected();
 *      }
 *
 * ============================================================
 */

class Session {

    //// 1. Démarrer automatiquement la session PHP si elle n’est pas déjà active
    public function __construct(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    //// 2. Déclarer qu’un utilisateur est connecté
    public function logged($id) {
        // Rôle : déclarer qu'un utilisateur est connecté
        // Paramètre : 
        //      $id : id de l'utilisateur
        // Retour : true si réussi, false sinon

        $_SESSION["id"] = $id;
        return true;
    }

    //// 3. Déconnecter l’utilisateur
    public function logOut(){
        // Rôle : déconnecter l'utilisateur connecté
        // Paramètre : néant
        // Retour : true si réussi false sinon

        unset($_SESSION["id"]);
        return true;
    }

    //// 4. Indiquer si un utilisateur est actuellement connecté
    public function isLogged(){
        // Rôle : indiquer si un utilisateur est connecté
        // Paramètres : néant
        // Retour : true si une connexion est active; false sinon

        return isset($_SESSION["id"]);
    }

    //// 5. Retourner l’id de l’utilisateur connecté
    public function idConnected(){
        // Rôle: renvoi l'id de l'utilisateur connecté ou 0
        // Paramètre:
        //          néant
        // Retour: 0 ou l'id

        return $this->isLogged() ? $_SESSION['id'] : 0;
    }

    //// 6. Getter
    public function get($key) {
        // rôle: récupére la valeur associé à une clé dans la session
        // paramètre: 
        //          - $key: clé dont on veut récupérer la valeur
        // retour:
        //          - la valeur de la clé ou null sinon

        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    //// 7. Setter
    public function set($key, $value) {
        // rôle: définir ou modifier une valeur d'une clé de la session
        // paramètres:
        //          - $key: clé à laquelle associée la valeur
        //          - $valeur: valeur de la clé a attribué
        // retour:
        //          - néant
        $_SESSION[$key] = $value;
    
    }
}