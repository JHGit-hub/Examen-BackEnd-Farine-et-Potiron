<?php
/**
 * ============================================================
 *  Classe : Comment
 *  Rôle global :
 *      - Modélise les commentaires associés à une recette et à un utilisateur.
 *      - Permet d’extraire les commentaires d’une recette ou d’un utilisateur via des méthodes dédiées.
 *      - Hérite des méthodes génériques de _model pour la gestion CRUD et la transformation des données.
 *
 *  Principales méthodes :
 *      1. getComments($id)        : Récupère tous les commentaires et notes liés à une recette.
 *      2. getCommentsByUser($id)  : Récupère tous les commentaires et notes laissés par un utilisateur donné.
 *
 *  Convention :
 *      - Les champs protégés correspondent aux colonnes de la table 'comments'.
 *      - Les liens permettent d’associer automatiquement chaque commentaire à son utilisateur et à sa recette.
 *      - Les méthodes de la classe retournent des tableaux d’objets Comment.
 *
 * ============================================================
 */


class Comment extends _model{


    protected $table = 'comments'; // nom de la table dans la bdd

    protected $champs = ["user_id", "recipe_id", "content", "rate","creation_date", "update_date"]; // liste des champs dans la table (sans id)
    protected $liens = ["user_id" => "User", "recipe_id" => "Recipe"]; // liens entre ce modéle et les tables associées

    protected $user_id; // l'id de l'utilisateur ayant créé le commentaire
    protected $recipe_id; // l'id de la recette à laquelle est associé le commentaire
    protected $content; // le contenu du commentaire
    protected $rate; // la note associée au commentaire (1 à 5)
    protected $creation_date; // la date de création du commentaire
    protected $update_date; // la date de mise à jour du commentaire


    ////1. Extraire la liste des commentaires et note d'une recette
    function getComments(int $id){
        // rôle: extraire la liste des commentaires et notes d'une recette
        // paramètres: 
        //          - $id: identifiant de la recette
        // retour:
        //          - tableau d'objet de la liste des commentaires et notes de la recette

        // Création de la requête
        $sql = "SELECT " . $this->sqlConstruct() . " FROM comments WHERE recipe_id = :id";
        $param = [":id" => $id];

        // Exécution
        $resultats = self::$bdd->bddGetAll($sql, $param);

        // Transformation en objets
        return $this->tblTransform($resultats);

    }

    ////2. Extraire la liste des commentaires et note laissés par l'utilisateur connecté
    function getCommentsByUser(int $id){
        // Rôle:
        //      - extraire la liste des commentaires et notes laissés par l'utilisateur connecté
        // paramètres:
        //      - $id: identifiant de l'utilisateur connecté
        // retour:
        //      - tableau d'objets représentant les commentaires et notes laissés par l'utilisateur

        //création de la requête
        $sql = "SELECT * FROM comments WHERE user_id = :id";
        $param = [":id" => $id];

        // Exécution de la requête
        $resultats = self::$bdd->bddGetAll($sql, $param);

        // Transformation en objets
        return $this->tblTransform($resultats);
    }
}
