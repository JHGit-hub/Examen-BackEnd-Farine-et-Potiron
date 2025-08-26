<?php




class Ingredient extends _model{

    protected $table = 'ingredients'; // nom de la table dans la bdd

    protected $champs = ["reference", "quantity", "unit", "recipe_id"]; // liste des champs dans la table (sans id)
    protected $liens = ["recipe_id" => "Recipe"]; // liens entre ce modéle et la table associée
}