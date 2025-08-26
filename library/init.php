<?php
session_start();
// Initialisations communes à tous les controleurs 


// mise en place des messages d'erreur
ini_set('display_errors',1);
error_reporting(E_ALL);

// Charger les librairies
include_once "library/bdd.php";
include_once "library/session.php";

// Charger les différentes classes de modèle de données
include_once "model/_model.php";
include_once "model/user.php";
include_once "model/recipe.php";
include_once "model/flour.php";
include_once "model/ingredient.php";
include_once "model/comment.php";


// Instanciation de la session
$session = new Session();

// Connexion PDO
$pdo = new PDO("mysql:host=172.18.0.1;dbname=fep-juha;charset=UTF8", "fep-juha", "P*20ugbgni");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


// Initialisation de la classe Bdd pour tous les modèles
_model::initBdd($pdo);