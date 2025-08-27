<?php
/**
 * ============================================================
 *  Classe : Ingredient
 *  Rôle global :
 *      - Modélise les ingrédients associés à une recette.
 *      - Permet d’extraire la liste des ingrédients d’une recette et d’enregistrer un ensemble d’ingrédients à partir d’un tableau (ex: provenant de la session).
 *      - Hérite des méthodes génériques de _model pour la gestion CRUD et la transformation des données.
 *
 *  Principales méthodes :
 *      1. getIngredients($id)                  : Récupère tous les ingrédients liés à une recette.
 *      2. saveIngredientsFromArray($ingredients, $id) : Ajoute plusieurs ingrédients à une recette en base à partir d’un tableau.
 *
 *  Convention :
 *      - Les champs protégés correspondent aux colonnes de la table 'ingredients'.
 *      - Les liens permettent d’associer automatiquement chaque ingrédient à sa recette.
 *      - Les méthodes de la classe manipulent et transforment les données en objets Ingredient.
 *
 * ============================================================
 */



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

    ////2. Enregistrer des ingredients dans la table de données à partir d'un tableau de la session et de l'id d'une recette
    public static function saveIngredientsFromArray(array $ingredients, int $id){
        // Rôle: 
        //      - enregistrer les ingrédients dans la table de données avec leurs quantité, unité de mesure et l'id de la recette dont ils font partis
        // paramètres:
        //      - $ingredients: tableau de tableaux associatifs contenant les ingrédients à ajouter à la recette
        //      - $id: identifiant de la recette à laquelle les ingrédients sont associés
        // retour:
        //      - néant
        
        // création de la requête sql
        $sql = "INSERT INTO `ingredients` (reference, quantity, unit, recipe_id) VALUES (:reference, :quantity, :unit, :recipe_id)";

        // On parcours le tableau des ingredients
        foreach ($ingredients as $ingredient) {
            $param = [
                ":reference" => $ingredient["reference"],
                ":quantity" => $ingredient["quantity"],
                ":unit" => $ingredient["unit"],
                ":recipe_id" => $id
            ];

            // On exécute la requête pour chaque ingrédient
            self::$bdd->bddRequest($sql, $param);
        }

        // Mise a jour de la date de modification de la recette
        // On demande à la bdd de donner la date du jour a update_date
        $sql_update_date = "UPDATE recipes SET update_date = NOW() WHERE id = :id";
        $param_update_date = [":id" => $id];

        // On execute la requête
        self::$bdd->bddRequest($sql_update_date, $param_update_date);
    }
}