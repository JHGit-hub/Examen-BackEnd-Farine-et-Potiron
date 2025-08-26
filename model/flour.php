<?php



class Flour extends _model{

    protected $table = 'flours'; // nom de la table dans la bdd

    protected static $apiFlourCatalogue = 'https://api.mywebecom.ovh/play/fep/catalogue.php'; // adresse URL de l'API du catalogue des farines
    protected static $apiFlourDetail = 'https://api.mywebecom.ovh/play/fep/catalogue.php?ref='; // adresse URL de l'API du détail d'une farine (à compléter avec la référence de la farine)


    protected $champs = ["reference", "recipe_id", "quantity"]; // liste des champs dans la table (sans id)
    protected $liens = ["recipe_id" => "Recipe"]; // liens entre ce modéle et la table associée



    ///1. Récuperer le catalogue des farines
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

    ///2. Récuperer le détail d'une farine
    public static function getFlourDetail($reference){
        // rôle: 
        //      - Extraire le détail d'une farine issus de l'API des déatils des farines
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