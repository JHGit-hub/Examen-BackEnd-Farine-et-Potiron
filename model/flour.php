<?php



class Flour extends _model{

    protected $table = 'flours'; // nom de la table dans la bdd

    protected $champs = ["reference", "recipe_id", "quantity"]; // liste des champs dans la table (sans id)
    protected $liens = ["recipe_id" => "Recipe"]; // liens entre ce modéle et la table associée
}