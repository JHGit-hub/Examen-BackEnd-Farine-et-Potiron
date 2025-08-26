<?php


class Recipe extends _model{

    protected $table = 'recipes'; // nom de la table dans la bdd

    protected $champs = ["title", "user_id", "execution_time", "description", "difficulty", "creation_date", "update_date"]; // liste des champs dans la table (sans id)
    protected $liens = ["user_id" => "User"]; // liens entre ce modéle et la table associée
}