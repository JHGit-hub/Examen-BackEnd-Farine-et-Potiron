<?php


class Recipe extends _model{

    protected $table = 'recipes'; // nom de la table dans la bdd

    protected $champs = ["title", "user_id", "execution_time", "description", "difficulty", "creation_date", "update_date"]; // liste des champs dans la table (sans id)
    protected $liens = ["user_id" => "User"]; // liens entre ce modéle et la table associée

    protected $title; // le titre de la recette
    protected $user_id; // l'id de l'utilisateur ayant créé la recette
    protected $execution_time; // le temps d'exécution de la recette (en minutes)
    protected $description; // la description de la recette
    protected $difficulty; // le niveau de difficulté de la recette (1 à 5)
    protected $creation_date; // la date de création de la recette
    protected $update_date; // la date de mise à jour de la recette


    ////1. Récupèrer la liste des recettes
    function getRecipes(string $flour1, string $flour2, string $difficulty){
        // rôle: filtrer les recettes selon des critères choisis dans un formulaire ou toutes par défaut
        // paramètre:
        //          - $flour1: référence de la première farine sélectionnée
        //          - $flour2: référence de la deuxième farine sélectionnée
        //          - $difficulty: niveau de difficulté de la recette
        // retour:
        //          - tableau d'objet représentants les recettes filtrées ou toutes par défaut, indéxé par les id

        // Extraction de la liste des recettes filtrées par la date d'achat

        // Construction de la requête:
        $sql = "SELECT * FROM recipes WHERE 1=1";
        $param = [];

        // filtre par premiére réfèrence farine
        if (!empty($flour1)) {
            $sql .= " AND flours.reference = :flour1";
            $param[":flour1"] = $flour1;
        }

        // filtre par deuxiéme réfèrence farine
        if (!empty($flour2)) {
            $sql .= " AND flours.reference = :flour2";
            $param[":flour2"] = $flour2;
        }

        // filtre par niveau de difficulté
        if (!empty($difficulty)) {
            $sql .= " AND recipes.difficulty = :difficulty";
            $param[":difficulty"] = $difficulty;
        }

        // Exécution
        $resultats = self::$bdd->bddGetAll($sql, $param);

        // Transformation en objets
        return $this->tblTransform($resultats);
    }
}