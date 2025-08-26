<?php


class Recipe extends _model
{

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

    protected $reference; // la référence de la farine
    protected $recipe_id; // l'id de la recette à laquelle est associée la farine
    protected $quantity; // la quantité de farine (en grammes) nécessaire pour la recette


    ////1. Extraire la liste des recettes
    function getRecipes(string $flour1, string $flour2, string $difficulty)
    {
        // rôle: filtrer les recettes selon des critères choisis dans un formulaire ou toutes par défaut
        // paramètre:
        //          - $flour1: référence de la première farine sélectionnée
        //          - $flour2: référence de la deuxième farine sélectionnée
        //          - $difficulty: niveau de difficulté de la recette
        // retour:
        //          - tableau d'objet représentants les recettes filtrées ou toutes par défaut, indéxé par les id

        // Extraction de la liste des recettes filtrées par la date d'achat

        // Construction de la requête:
        // On selectionne toutes les recettes et associe pour chaque recette la farine qui lui est liée
        $sql = "SELECT * FROM recipes LEFT JOIN flours ON flours.recipe_id = recipes.id WHERE 1=1";
        $param = [];

        // filtre sur Flour1 et flour2 si les deux sont sélectionnées et différentes
        if (!empty($flour1) && !empty($flour2) && $flour1 !== $flour2) {
            $sql .= " AND flours.reference = :flour1 OR flours.reference = :flour2";
            $param .= [":flour1" => $flour1, ":flour2" => $flour2];
        } elseif (!empty($flour1)) {
            // filtre par premiére réfèrence farine
            $sql .= " AND flours.reference = :flour1";
            $param[":flour1"] = $flour1;
        } elseif (!empty($flour2)) {
            // filtre par deuxiéme réfèrence farine
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

    ////2. Extraire la liste des recettes créées par l'utilisateur
    function getRecipesCreatedByUser(int $id){
        // Rôle:
        //      - Extraire la liste des recettes créées par l'utilisateur
        // paramètres:
        //      - $id: identifiant de l'utilisateur connecté
        // retour:
        //      - tableau d'objets représentant les recettes créées par l'utilisateur

        // Création de la requête
        $sql = "SELECT * FROM recipes WHERE user_id = :id";
        $param = [":id" => $id];

        //Préparation et execution de la requête
        $resultats = self::$bdd->bddGetAll($sql, $param);

        return $this->tblTransform($resultats); // converti le résultat et renvoi un tableau d'objets
    }
}
