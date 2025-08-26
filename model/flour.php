<?php



class Flour extends _model{

    protected $table = 'flours'; // nom de la table dans la bdd

    protected static $apiFlourCatalogue = 'https://api.mywebecom.ovh/play/fep/catalogue.php'; // adresse URL de l'API du catalogue des farines
    protected static $apiFlourDetail = 'https://api.mywebecom.ovh/play/fep/catalogue.php?ref='; // adresse URL de l'API du détail d'une farine (à compléter avec la référence de la farine)


    protected $champs = ["reference", "recipe_id", "quantity"]; // liste des champs dans la table (sans id)
    protected $liens = ["recipe_id" => "Recipe"]; // liens entre ce modéle et la table associée

    protected $reference; // la référence de la farine
    protected $recipe_id; // l'id de la recette à laquelle est associée la farine
    protected $quantity; // la quantité de farine (en grammes) nécessaire pour la recette

    ///1. Extraire le catalogue des farines
    public static function getFlourCatalogue(){
        //rôle:
        //      - extraire le catalogue des farines depuis l'API
        // paramètres:
        //      - $apiFlourCatalogue: l'URL de l'API du catalogue des farines
        // retour:
        //      - un tableau associatif contenant le catalogue des farines, false sinon

        // construction de l'url de l'API
        $urlApi = self::$apiFlourCatalogue;

        // initialisation de l'API
        $api = curl_init($urlApi);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        // on soumet la requête et on récupére le résultat
        $response = curl_exec($api);

        if($response === false){
            echo "Echec de la requête : " . curl_error($api);
            curl_close($api);
            return false;
        }

        // on ferme la session cURL (bonne pratique: libération de mémoire notamment)
        curl_close($api);

        // on décode la réponse et on la retourne
        return json_decode( $response, true);
    }

    ///2. Extraire la référence et la quantité d'une farine utilisé à partir de l'identifiant d'une recette
    function getFlourReferenceAndQuantityById(int $id){
        // Rôle:
        //      - extraire la référence et la quantité de la farine utilisé à partir d'un identifiant de recette
        // paramètres:
        //      - $id: identifiant de la recette
        // retour:
        //      - $objet contenant les details demandées

        // création de la requête
        $sql = "SELECT reference, quantity FROM flours WHERE recipe_id = :id";
        $param = [":id" => $id];

        // Préparation et exécution de la requête
        $row = self::$bdd->bddGetFirstLigne($sql, $param);

        if($row && isset($row["reference"]) && isset($row["quantity"])){
            // si $row n'est pas false et si $row["reference"] et $row["quantity"] existent
            $result = [
                "reference" => $row["reference"],
                "quantity" => $row["quantity"]
            ];
        } else {
            $result = false;
        }

        return $result;
    }

    ///3. Extraire le détail d'une farine
    public static function getFlourDetail(string $reference){
        // rôle: 
        //      - Extraire le détail d'une farine issus de l'API des détails des farines
        // paramètres
        //      - $reference: la référence de la farine à récupérer
        // retour:
        //      - tableau associatif contenant le détail de la farine, false sinon

        // Construction de l'url de l'api
        $urlApi = self::$apiFlourDetail . urlencode($reference); // urlencode() encode une string pour être compatible avec une URL
        
        // initialisation de l'API
        $api = curl_init($urlApi);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        // on soumet la requête et on récupére le résultat
        $response = curl_exec($api);

        if($response === false){
            echo "Echec de la requête : " . curl_error($api);
            curl_close($api);
            return false;
        }

        // on ferme la session cURL (bonne pratique: libération de mémoire notamment)
        curl_close($api);

        // on décode la réponse et on la retourne
        return json_decode( $response, true);
    }
}