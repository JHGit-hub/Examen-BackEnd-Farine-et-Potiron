<?php

/**
 * ============================================================
 *  Classe : _model
 *  Rôle global :
 *      - Sert de classe générique pour la manipulation d’un objet du MCD (Modèle Conceptuel de Données).
 *      - Centralise les méthodes courantes pour CRUD, chargement de données, gestion des fichiers, transformations, et génération HTML.
 *      - Utilise la classe Bdd pour toutes les opérations sur la base de données.
 *
 *  Principales méthodes :
 *      1. static initBdd($pdo)            : Initialise la connexion à la base via PDO (une seule connexion partagée).
 *      2. __construct($id = null)         : Instancie l’objet et charge ses données si un id est fourni.
 *      3. is()                            : Indique si l’objet est chargé depuis la BDD.
 *      4. id()                            : Retourne la valeur de la clé primaire (id) de l’objet.
 *      5. get($nomChamp)                  : Retourne la valeur d’un champ ou de l’objet lié.
 *      6. set($nomChamp, $valeur)         : Modifie la valeur d’un champ.
 *      7. loadFromId($id)                 : Charge l’objet depuis la BDD via son id.
 *      8. update()                        : Met à jour la ligne courante dans la table.
 *      9. insert()                        : Insère une nouvelle ligne (remplit l’id si succès).
 *     10. delete()                        : Supprime la ligne courante de la BDD.
 *     11. getAll()                        : Récupère tous les objets de la table (indexés par id).
 *     12. loadFromField($champ, $valeur)  : Charge l’objet via la valeur d’un champ spécifique.
 *     13. storeFile(...)                  : Stocke un fichier uploadé dans le dossier voulu.
 *     14. sqlConstruct()                  : Génère la liste des champs pour les requêtes SELECT.
 *     15. loadFromTab($tab)               : Charge les valeurs des champs à partir d’un tableau associatif.
 *     16. loadFromFiles($files)           : Charge les fichiers uploadés depuis un tableau ($_FILES).
 *     17. tblTransform($tab)              : Transforme un tableau SQL en tableau d’objets du modèle (indexé par id).
 *     18. static createSelect(...)        : Génère un <select> HTML trié et sans doublon.
 *     19. static createListFiltered(...)  : Génère une liste HTML filtrée d’éléments avec callback JS.
 *
 *  Convention :
 *      - Tous les accès BDD passent par self::$bdd, instance unique de Bdd.
 *      - Les méthodes d’instance manipulent les attributs et valeurs du modèle courant.
 *      - Les méthodes statiques génèrent du HTML pour l’UI (select, listes...).
 *      - L’attribut $liens permet de retourner des objets liés automatiquement.
 *
 *  Exemple d’utilisation :
 *      _model::initBdd($pdo);
 *      $user = new User(5); // charge l’utilisateur id=5
 *      $user->set('email','test@mail.com'); $user->update();
 *      $liste = $user->getAll();
 *      echo User::createSelect($liste, "lastname", "select_user");
 *
 * ============================================================
 */

// Inclure la classe Bdd
include_once "library/bdd.php";


class _model
{

    // Attribut statique pour la connexion Bdd partagée à tous les objets
    protected static $bdd = null;   // Instance partagée de la classe `Bdd` pour toutes les opérations BDD

    // Attributs
    protected $table = "";          // Nom de la table associée à l’objet
    protected $champs = [];         // Tableau contenant les noms des champs (hors `id`)
    protected $liens = [];          // tableau  [ nomChamp => objetPointé, .... ]

    protected $valeurs = [];        // Tableau associatif contenant les valeurs des champs
    protected $id;                  // Valeur de la clé primaire (`id`) de l’objet


    /////////// méthode de gestion de la connexion Bdd

    //// 1. Initialiser la connexion à la base via PDO
    public static function initBdd(PDO $pdo)
    {
        // rôle: crée une instance de la classe Bdd et l'assigne à $bdd
        // paramètre:
        //          - $pdo: objet PDO représentant la connexion à la base de données
        // retour:
        //          - néant
        self::$bdd = new Bdd($pdo);
    }


    /////////// Constructeur

    //// 2. Créer un nouvel objet
    function __construct($id = null)
    {
        // Rôle : constructeur : charger une ligne de la BDD si on précise un id
        // Paramètre :
        //          - $id (facultatif) : id de la ligne à charger
        // retour:
        //          - néant

        if (! is_null($id)) {
            $this->loadFromId($id);
        }
    }


    /////////// Méthode d'état et d'accés à l'id

    //// 3. Indiquer si l’objet est chargé
    function is()
    {
        // Rôle : indiquer si l'objet est chargé ou non
        // Paramètres : 
        //          - néant
        // Retour : 
        //          - true si l'objet est chargé, false sinon

        return ! empty($this->id);
    }

    //// 4. Retourner la valeur de la clé primaire
    function id()
    {
        // Rôle : retourner l'id de l'objet dans la BDD ou 0
        // Paramètres : 
        //          - néant
        // Retour : 
        //          - la valeur de l'id ou 0

        return $this->id;
    }


    ///////////// Getters et Setters

    //// 5. Retourner la valeur d’un champ
    function get(string $nomChamp)
    {
        // Rôle : Getters; Récupérer la valeur d'un Champ ou d'une propriété dynamique
        // Paramètres : 
        //          - $nomChamp : nom du Champ à récupérer
        // Retour : 
        //          - valeur du Champ ou valeur par défaut (chaine vide)
        //          - si le champ est un lien, on retourne l'objet pointé


        // On vérifie si le champ est un lien 
        if (isset($this->liens[$nomChamp])) {
            if (empty($this->valeurs[$nomChamp])) return null;
            // On veut retourner l'objet pointé 
            $typeObjet = $this->liens[$nomChamp];
            $objetPointe = new $typeObjet($this->valeurs[$nomChamp]);
            return $objetPointe;
        }

        // On verifie si le champ existe dans la table
        if (in_array($nomChamp, $this->champs)) {
            // On verifie s'il y a une valeur
            if (isset($this->valeurs[$nomChamp])) {
                // On a un valeur : on la retourne
                return $this->valeurs[$nomChamp];
            } else {
                return "";
            }
        }

        // On verifie si la propriété est ajouté dynamiquement à l'objet
        if (property_exists($this, $nomChamp)) {
            return $this->$nomChamp;
        }

        // Sinon, champ inconnu
        return "";
    }

    //// 6. Définir la valeur d’un champ
    function set(string $nomChamp, $valeur)
    {
        // Rôle : Setter; donne ou modifie la valeur d'un Champ
        // Paramètres :
        //          - $nomChamp : nom de la Champ concerné
        //          - $valeur : nouvelle valeur de la Champ
        // Retour : 
        //          - true si ok, false sinon

        // Vérification si $nomChamp est un Champ, s'il n'existe pas, on retourne false
        if (! in_array($nomChamp, $this->champs)) {
            return false;
        }

        // On met la valeur dans le tableau des valeurs
        $this->valeurs[$nomChamp] = $valeur;
        return true;
    }


    ///////////// Méthodes de manipulation de la bdd

    //// 7. Charger l’objet depuis la BDD
    function loadFromId($id)
    {
        // Rôle : Extraire les données d'un objet à partir de son id
        // Paramètre :
        //          - $id: clé primaire de l'objet
        // Retour: 
        //          - true si succés et on rempli le tableau $this->valeurs, false sinon


        // Construire la requête : SELECT en utilisant sqlConstruct
        $sql = "SELECT " . $this->sqlConstruct() . " FROM `$this->table` WHERE `id` = :id";

        // Extraire la première ligne
        $tab = self::$bdd->bddGetFirstLigne($sql, [":id" =>  $id]);

        // On verifie le cas d'échec
        if (!$tab) {
            $this->valeurs = [];
            $this->id = null;
            return false;
        }

        // On a un objet : on remplit donc les valeurs avec les données du tableau
        $this->loadFromTab($tab);
        $this->id = $id;
        return true;
    }

    //// 8. Mettre à jour la ligne courante dans la table
    function update()
    {
        // Rôle : mette à jour l'objet courant dans la BDD
        // Paramètres : 
        //          - néant
        // Retour : 
        //          - true si ok, false sinon

        // Si l'objet n'est pas chargé : on refuse
        if (! $this->is()) {
            return false;
        }

        // On ignore le champ password s'il est vide ou null
        if (
            array_key_exists('password', $this->valeurs) &&
            ($this->valeurs['password'] === null || $this->valeurs['password'] === "")
        ) {
            unset($this->valeurs['password']);
        }

        return self::$bdd->bddUpdate($this->table, $this->valeurs, $this->id);
    }

    //// 9. Insèrer une nouvelle ligne dans la table
    function insert()
    {
        // Rôle : créer l'objet courant dans la BDD
        // Paramètres : 
        //          - néant
        // Retour : 
        //          - true si ok, false sinon

        // Si l'objet est chargé : on refuse
        if ($this->is()) {
            return false;
        }

        // On ignore le champ password s'il est vide ou null
        if (
            array_key_exists('password', $this->valeurs) &&
            ($this->valeurs['password'] === null || $this->valeurs['password'] === "")
        ) {
            unset($this->valeurs['password']);
        }

        $id = self::$bdd->bddInsert($this->table, $this->valeurs);

        // On verifie le succés de l'opération
        if (empty($id)) return false;

        // On retourne la clé primaire
        $this->id = $id;
        return true;
    }

    //// 10. Supprimer la ligne courante de la BDD
    function delete()
    {
        // Rôle : supprimer l'objet courant de  la BDD
        // Paramètres : 
        //          - néant
        // Retour : 
        //          - true si ok, false sinon

        // Si l'objet n'est pas chargé : on refuse
        if (! $this->is()) {
            return false;
        }

        $resultat = self::$bdd->bddDelete($this->table, $this->id);

        // On verifie le succés de l'opération
        if (!$resultat) return false;

        // On vide l'id et on retourne true 
        $this->id = null;
        return true;
    }

    //// 11. Récupèrer tous les objets de la table
    function getAll()
    {
        // Rôle : récupérer tous les objets de ce type dans la BDD
        // Paramètres : 
        //          - néant
        // Retour : 
        //          - tableau indexé d'objets, indexé par l'id

        // Construire la requête : SELECT
        $sql = "SELECT " . $this->sqlConstruct() . " FROM `$this->table`";

        // Extraction des lignes :
        $tab = self::$bdd->bddGetAll($sql);

        // Transformation du "tableau de tableau" en un tableau d'objets
        return $this->tblTransform($tab);
    }

    //// 12. Charger l’objet depuis la BDD
    function loadFromField(string $champ, $valeurChamp)
    {
        // rôle : extraire les données de la bdd concernant l'utilisateur à partir d'un champ spécifique
        // paramètre : 
        //          - $champ: champ à partir du quel on veux charger les données objets
        //          - $valeurChamp: la valeur du champ concerné
        // retour : 
        //          - true, false sinon


        //construction de la requête:
        $sql = "SELECT " . $this->sqlConstruct() . " FROM `$this->table` WHERE `$champ` = :valeur";
        $param = [":valeur" => $valeurChamp];

        // Extraire la première ligne
        $ligne = self::$bdd->bddGetFirstLigne($sql, $param);

        if (empty($ligne)) {
            return false;
        }

        // On a un objet : on remplit donc les valeurs avec les données du tableau
        $this->loadFromtab($ligne);
        $this->id = $ligne["id"];
        return true;
    }

    //// 13. Stocker un fichier uploadé
    function storeFile(string $tempFile, string $name, string $champ, string $subDir)
    {
        // rôle: stocke un fichier temporaire comme photo de l'utilisateur courant (il doit être chargé)
        // paramètres:
        //          - $tempFile : chemin du fichier temporaire
        //          - $name : nom original du fichier
        //          - $champ : nom du champ à mettre à jour
        //          - $subDir: sous-dossier spécifique (ex: user/photo)
        // retour:
        //          - true si réussi, false sinon

        // On verifier qu'on a un fichier
        if (!is_uploaded_file($tempFile)) return false;

        // On verifier que l'objet soit chargé
        if (!$this->is()) return false;

        // Construction du nom : id objet + extension d'origine
        $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $filename = $this->id() . "." . $extension;

        // Utilisation d'un dossier aléatoire entre 10 et 99
        $dir = rand(10, 99);

        // Zone de stockage générale
        $basePath = $_SERVER['DOCUMENT_ROOT'] . '/files';
        $path = "$basePath/$subDir";

        // Suppression de l'ancien fichier si il existe
        $old = $this->get($champ);
        if (is_string($old) && $old && file_exists("$path/$old")) {
            unlink("$path/$old");
        }

        // Création du dossier si nécessaire
        if (!is_dir("$path/$dir")) mkdir("$path/$dir", 0770, true);

        // Stockage du nouveau fichier
        $destination = "$path/$dir/$filename";
        if (!move_uploaded_file($tempFile, $destination)) return false;

        // Mise à jour du champ dans l’objet
        $this->set($champ, "$subDir/$dir/$filename");
        return $this->update();
    }

    ///////////// Méthodes utilitaires

    //// 14. Génèrer la liste des champs
    function sqlConstruct()
    {
        // rôle : construire l'extrait de la commande sql contenant le nom des Champs
        // paramètres:
        //          - néant
        // retour: 
        //          - le texte a concaténer dans la requête sql

        // On créer l'extrait de commande
        $sqlConcatene = "`id`";

        // On boucle avec foreach pour ajouter le nom des Champs dans l'extrait de commande sql
        foreach ($this->champs as $nomChamp) {
            $sqlConcatene .= ", `$nomChamp`";
        }
        return $sqlConcatene;
    }

    //// 15. Charger les valeurs des champs
    function loadFromTab(array $tab)
    {
        // Rôle : extraire les valeurs des Champs dans un tableau indexé par les noms des Champs (sauf l'id)
        // Paramètres :
        //          - $tab : tableau indexé comportant en index le noms des Champs de cet objet et leurs valeurs
        // Retour : 
        //          - true si ok, false sinon

        // On verifie si on a une valeur dans le tableau 
        // on donne cette valeur au bon Champ
        foreach ($this->champs as $nomChamp) {
            if (isset($tab[$nomChamp])) {
                $valeur = $tab[$nomChamp];

                // On ignore le champ "password" s'il est vide (car non modifier)
                if ($nomChamp === "password" && $valeur === "") {
                    continue;
                }

                //Si la valeur est une chaine vide, on la converti en NULL
                if ($valeur === "") {
                    $valeur = NULL;
                };


                // On affecte la valeur au champ avec le setter
                $this->set($nomChamp, $valeur);
            }
        }
        return true;
    }

    //// 16. Charge les fichiers uploadés
    function loadFromFiles(array $files)
    {
        // Rôle : extraire les fichiers uploadés dans un tableau indexé par les noms des Champs (hors id)
        // Paramètre :
        //          - $files : tableau indexé par les noms des Champs, typiquement $_FILES
        // Retour :
        //          - true si ok, false sinon

        foreach ($this->champs as $nomChamp) {
            // On vérifie si le champ existe dans $_FILES et si un fichier a bien été uploadé
            if (isset($files[$nomChamp]) && isset($files[$nomChamp]['tmp_name']) && $files[$nomChamp]['tmp_name'] !== '') {
                $file = $files[$nomChamp];

                // Si pas d’erreur et qu’on a bien un fichier
                if ($file['error'] === UPLOAD_ERR_OK) {

                    // On affecte la valeur au champ avec le setter
                    $this->set($nomChamp, $file);
                }
            }
        }
        return true;
    }

    //// 17. Transformer un tableau de tableaux
    function tblTransform(array $tab)
    {
        // Rôle : transformer un tableau de tableaux en un tableau d'objet enrichi 
        //          (pour tous les champs additionnels issus de jointures SQL)
        // Paramètres :
        //          - $tab : le tableau à transformer
        // Retour : 
        //          - tableau d'objets de la classe courant, indexé par l'id

        // On part d'un tableau de résultat vide
        $resultat = [];
        // Pour chaque élément de $tab 
        foreach ($tab as $element) {
            // On créée un objet de la class courante enfant de _model
            $objet = new static();

            // On charge les valeurs des Champs
            $objet->loadFromTab($element);

            // On charge l'id
            $objet->id = $element["id"];

            // Ajout dynamique des champs supplémentaires (ex : reference)
            foreach ($element as $key => $value) {
                $objet->$key = $value;
            }

            // On l'ajoute à $resultat au bon index
            $resultat[$objet->id()] = $objet;
        }
        return $resultat;
    }

    ///////////// Méthodes statiques

    //// 18. Génèrer un `<select>` HTML
    public static function createSelect(array $objects, string $attribute, string $selectName, string $optionName = ""): string
    {
        // rôle: Générer un <select> HTML pour un attribut issu d'une liste d'objets, trié et sans doublon
        // paramètres:
        //          - $objects:  liste d'objets
        //          - $attribute: nom de l'attribut à extraire
        //          - $selectname: nom et id du select
        //          - $optionName: le texte de l'option par defaut à afficher
        // retour:
        //          - code HTML du <select>

        // tri de la liste par ordre croissant et suppressions des doublons

        $unique_option = [];
        foreach ($objects as $obj) {
            $value = $obj->get($attribute);
            // on verifie si attribut existe dèjà dans le tableau $unique_option
            // Si oui, on l'ajoute, sinon on l'ignore
            if (!in_array($value, $unique_option)) {
                $unique_option[] = $value;
            }
        }
        // tri de la liste par ordre alphabétique
        sort($unique_option);

        // génération du HTML

        $html = "<select name='" . htmlspecialchars($selectName) . "' id='" . htmlspecialchars($selectName) . "'>";
        $html .= "<option value=''>" . htmlspecialchars($optionName) . "</option>";
        foreach ($unique_option as $opt) {
            $html .= "<option value='" . htmlspecialchars($opt) . "'>" . htmlspecialchars($opt) . "</option>";
        }
        $html .= "</select>";
        return $html;
    }

    ////19. Génèrer une liste HTML d’éléments filtrés
    public static function createListFiltered(array $objects, string $controller, string $attribute, string $firstLabel, string $secondLabel = "",bool $isSecondDate = false): string
    {
        // rôle: générer une liste des objets filtrés sous forme de HTML
        // paramètres:
        //          - $objects: liste d'objects
        //          - $controller: nom du contrôleur à appeler
        //          - $attribute: nom de l'attribut de l'objet concerné passé en $_GET
        //          - $firstLabel: nom du premier champ à afficher
        //          - $secondLabel: nom du second champ à afficher
        //          - $isSecondDate: true si le second label est une date, false sinon
        // retour:
        //          - code HTML de la liste

        $html = "<div class='list_filtered'>\n";
        foreach ($objects as $obj) {
            // Récupération de l'identifiant
            if ($attribute === "id") {
                // si l'attribut est "id", on utilise la méthode id()
                $valueAttribute = htmlspecialchars($obj->id());
            } else {
                // sinon on utilise la méthode get()
                $valueAttribute = htmlspecialchars($obj->get($attribute));
            }


            // on extrait les valeurs des champs à afficher
            $label1 = htmlspecialchars($obj->get($firstLabel));
            // $label2 = $secondLabel ? htmlspecialchars($obj->get($secondLabel)) : "";

            $valueLabel2 = htmlspecialchars($obj->get($secondLabel));
            
            // on verifie si secondLabel est une date
            if($isSecondDate){
                $valueLabel2 = substr($valueLabel2, 0, 10); // si oui, on ne garde que année-mois-jour
                $label2 = date("d/m/Y", strtotime($valueLabel2)); // on met la date au format français                
            } else {
                $label2 = htmlspecialchars($valueLabel2);
            }

            $url = htmlspecialchars($controller) . "?" . htmlspecialchars($attribute) . "=" . urlencode($valueAttribute);

            $html .= '<a href="' . $url . '">';
            $html .= "<h3>" . $label1 . "</h3>";
            if($secondLabel) {
                $html .= "<p>" . $label2 . "</p>";
            }
            $html .= "</a>\n";
        }
        $html .= "</div>\n";
        return $html;
    }
}
