<?php



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


    ////1. Récupèrer la liste des commentaires et note d'une recette
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
}
