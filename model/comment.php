<?php



class Comment extends _model{


    protected $table = 'comments'; // nom de la table dans la bdd

    protected $champs = ["user_id", "recipe_id", "content", "rate","creation_date", "update_date"]; // liste des champs dans la table (sans id)
    protected $liens = ["user_id" => "User", "recipe_id" => "Recipe"]; // liens entre ce modéle et les tables associées
}
