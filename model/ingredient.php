<?php




class Ingredient extends _model{

    protected $table = 'ingredients'; // nom de la table dans la bdd

    protected $champs = ["reference", "quantity", "unit", "recipe_id"]; // liste des champs dans la table (sans id)
    protected $liens = ["recipe_id" => "Recipe"]; // liens entre ce modéle et la table associée

    protected $reference; // la référence de l'ingrédient
    protected $quantity; // la quantité d'ingrédient nécessaire pour la recette
    protected $unit; // l'unité de mesure de l'ingrédient
    protected $recipe_id; // l'id de la recette à laquelle est associé l'ingrédient



    ////1. Extraire la liste des ingredients d'une recette
    function getIngredients(int $id){
        // rôle: extraire la liste des ingrédients d'une recette
        // paramètres: 
        //          - $id: identifiant de la recette
        // retour:
        //          - tableau d'objet de la liste des ingrédients de la recette

        // Création de la requête
        $sql = "SELECT " . $this->sqlConstruct() . " FROM ingredients WHERE recipe_id = :id";
        $param = [":id" => $id];

        // Exécution
        $resultats = self::$bdd->bddGetAll($sql, $param);

        // Transformation en objets
        return $this->tblTransform($resultats);

    }
}