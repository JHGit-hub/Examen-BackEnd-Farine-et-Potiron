<?php

/**
 * ============================================================
 *  Classe : Bdd
 *  Rôle global :
 *      - Centralise toutes les méthodes d'accès à la base de données via PDO.
 *      - Facilite l'exécution des requêtes SQL (SELECT, INSERT, UPDATE, DELETE).
 *      - Fournit des méthodes utilitaires pour manipuler les données de façon sécurisée et réutilisable.
 *
 *  Principales méthodes :
 *      1. __construct($bdd)
 *          - Initialise la connexion PDO à la base de données.
 *          - À instancier en début de script : $bdd = new Bdd($pdo);
 *
 *      2. bddRequest($sql, $param = [])
 *          - Prépare et exécute une requête SQL paramétrée (SELECT, INSERT, etc.).
 *          - Retourne un objet PDOStatement si succès, false sinon.
 *
 *      3. bddGetFirstLigne($sql, $param = [])
 *          - Récupère la première ligne du résultat d'une requête SELECT.
 *          - Retourne un tableau associatif ou false si aucun résultat.
 *
 *      4. bddGetAll($sql, $param = [])
 *          - Récupère toutes les lignes du résultat d'une requête SELECT.
 *          - Retourne un tableau de tableaux associatifs ou vide.
 *
 *      5. bddSqlConstruct($valeurs)
 *          - Génère dynamiquement la clause SET et les paramètres pour une requête UPDATE.
 *          - Retourne un tableau avec 'sql' et 'param'.
 *
 *      6. bddInsert($table, $valeurs)
 *          - Insère une nouvelle ligne dans une table.
 *          - Retourne le dernier id inséré (int) ou 0 si échec.
 *
 *      7. bddUpdate($table, $valeurs, $id)
 *          - Met à jour une ligne à partir de son id.
 *          - Retourne true si succès, false sinon.
 *
 *      8. bddDelete($table, $id)
 *          - Supprime une ligne à partir de son id.
 *          - Retourne true si succès, false sinon.
 *
 *  Convention :
 *      - Toutes les méthodes utilisent des requêtes préparées pour sécuriser les échanges avec la base.
 *      - Les paramètres SQL sont toujours passés dans des tableaux associatifs.
 *      - Les erreurs d'exécution retournent false ou un tableau vide pour éviter les exceptions non gérées.
 *
 *  Exemple d’utilisation :
 *      $bdd = new Bdd($pdo);
 *      $resultats = $bdd->bddGetAll("SELECT * FROM users WHERE actif = 1");
 *
 * ============================================================
 */

class Bdd {

        private $bdd; // Objet PDO 

    //// 1. Initialiser la connexion PDO à la base de données
    public function __construct($bdd) {
        // rôle : initialise la connexion à la base de données en stockant l'objet PDO passé en paramètre
        // paramètre :
        //          - $bdd : instance de la connexion PDO à utiliser pour les requêtes vers la base de données
        // retour :
        //          - néant
        $this->bdd = $bdd;
    }
    
    //// 2. Préparer et exécuter une requête SQL
    public function bddRequest(string $sql, array $param = []){
        // rôle :préparer et executer une requête
        // paramètres:
        //          - $sql: texte de la commande $sql à executer et à preparer
        //          - $param : tableau des paramètres de la commande $sql ( vide si non préciser)
        // retour: 
        //          - la requête préparée et executée, false sinon

        // Préparer la requête
        $request = $this->bdd->prepare($sql);

        // Verifier si la préparation s'est bien executer
        if (!$request) {
            return false;
        }

        // Executer la requête
        $execute = $request->execute($param);

        // Verifier la bonne execution de la requête
        if(!$execute){
            return false;
        }

        return $request;
    }

    //// 3. Récupèrer la première ligne du résultat d’une requête SELECT
    public function bddGetFirstLigne(string $sql, array $param =[]) {
        // rôle : retourne la premiére ligne récupéré par un select sous forme d'un tableau indéxé
        // paramètres:
        //          - $sql : texte de la commande $sql
        //          - $param : tableau des paramètres de la commande $sql ( vide si par préciser)
        // retour: 
        //          - la premiére ligne récupérée ou false sinon

        // Préparer la requête
        $request = $this->bddRequest($sql, $param);

        // Verifier la bonne execution de la requête pour eviter les erreurs avec fetch
        if ($request === false) {
            return false;
        }

        // Récupération de la premiére ligne
        $firstLigne = $request->fetch(PDO::FETCH_ASSOC);

        // Verifer que $fisrtLigne n'est pas vide
        if(!$firstLigne){
            return false;
        }

        return $firstLigne;
    }

    //// 4. Récupèrer toutes les lignes du résultat d’une requête SELECT
    public function bddGetAll(string $sql, array $param =[]){
        // rôle : retourne toutes les lignes d'un SELECT sous forme d'un tableau de tableaux associatifs
        // paramètres:
        //          - $sql : texte de la commande $sql
        //          - $param : tableau des paramètres de la commande $sql ( vide si par préciser)
        // retour: 
        //          - tableau de tableaux associatifs, ou vide sinon
        
        // Préparer la requête
        $request = $this->bddRequest($sql, $param);

        // Verifier la bonne execution de la requête pour eviter les erreurs avec fetchAll
        if ($request === false) {
            return [];
        }

        // Récupération de toutes les lignes
        return $request->fetchAll(PDO::FETCH_ASSOC);

    }

    //// 5. Génèrer la clause SET et les paramètres pour une requête UPDATE.
    public function bddSqlConstruct(array $valeurs){
        // rôle : Construire l'extrait de la ligne de commande $sql avec pour chaque Champ de la table son nom;
        //           " `$nomChamp` = :$nomChamp " en les séparant par une virgule.
        //          - Et ajouter dans le tableau des Paramètres les valeurs des Champs selon leurs noms; :$nomChamp => valeur
        // Paramètres:
        //          - $valeurs : tableau contenant les valeurs des Champs
        // retour : 
        //          - extrait de ligne de commande $sqlConstruct et le tableau des paramètres $param

        // Création du tableau des paramètres vide
        $param = [];

        // Création de $sqlConstruct vide
        $sqlConstruct = "";

        // On doit créer la commande sql en ajoutant, pour chaque Champ de la table son nom; " `$nomChamp` = :$nomChamp " 
        // en les séparant par une virgule.
        // Et ajouter dans le tableau des Paramètres les valeurs des Champs selon leur nom
        // :$nomChamp => valeur

        // Ecriture de la ligne de commande en fonction des noms des Champs et de leurs valeurs
        $tab = []; // tableau contenant le nom des Champs et leurs valeurs

        foreach($valeurs as $nomChamp => $valeurChamp){
            $tab[] = "`$nomChamp` = :$nomChamp";
            $param[":$nomChamp"] = $valeurChamp;
        }

        // On concaténe les éléments du tableau à $sqlConstruct
        $sqlConstruct .= " SET " . implode(", ", $tab);

        return [
            "sql" => $sqlConstruct,
            "param" => $param
        ];

    }

    //// 6. Insèrre une nouvelle ligne dans une table
    public function bddInsert(string $table, array $valeurs){
        //  rôle : Insérer une nouvelle ligne dans la base de données
        //  paramètres:
        //          - $table : nom de la table de la bdd concernée
        //          - $valeurs : tableau contenant les valeurs des champs
        // retour: 
        //          - la clé primaire ou 0 si échec

        // On construit l'extrait de commande sql et le tableau des paramètres
        $construct = $this->bddSqlConstruct($valeurs);

        $sqlConstruct = $construct["sql"];
        $param = $construct["param"];

        // Construction de la commande $sql INSERT
        $sql = "INSERT INTO `$table` " . $sqlConstruct;

        // On utilise bddRequest()
        $request = $this->bddRequest($sql, $param);

        // Vérifier la bonne exécution de la requête
        if ($request === false) {
            return 0;
        }

        // Si succès, on retourne la valeur de la clé primaire nouvellement créée
        return $this->bdd->lastInsertId();

    }

    //// 7. Mettre à jour une ligne à partir de son id
    public function bddUpdate(string $table, array $valeurs, $id){
        // rôle : mettre à jour une ligne dans une table à partir de son id
        // paramètres :
        //          - $table : nom de la table
        //          - $valeurs : tableau associat champ => valeur
        //          - $id : identifiant de la ligne à modifier
        // retour : 
        //          - true si la mise à jour a réussi, false sinon

        // Construction de la partie SET et des paramètres
        $construct = $this->bddSqlConstruct($valeurs);
        $sql = "UPDATE `$table`" . $construct['sql'] . " WHERE id = :id";
        $param = $construct['param'];
        $param[':id'] = $id;

        $request = $this->bddRequest($sql, $param);

        return $request !== false;

    }

    //// 8. Supprimer une ligne à partir de son id.
    public function bddDelete(string $table, $id){
        // rôle : supprimer une ligne dans une table à partir de son id
        // paramètres :
        //          - $table : nom de la table
        //          - $id : identifiant de la ligne à supprimer
        // retour : 
        //          - true si la suppression a réussi, false sinon

        $sql = "DELETE FROM `$table` WHERE id = :id";
        $param = [':id' => $id];

        $request = $this->bddRequest($sql, $param);

        return $request !== false;

        }
}