<?php

namespace BWB\Framework\mvc\controllers;

use BWB\Framework\mvc\Controller;
use BWB\Framework\mvc\models\DefaultModel;
use BWB\Framework\mvc\models\TestModel;
use BWB\Framework\mvc\dao\DAOFlux;
use Exception;

/**
 * Ceci est un exemple de contrôleur 
 * il charge le security middleware dans le constructeur
 * 
 *
 * @author loic
 */
class FluxController extends SecurizedController
{

    /**
     * Le constructeur de la classe Controller charge les datas passées par le client,
     * Pour charger le security middleware, le contrôleur parent invoque la methode
     * @see \BWB\Framework\mvc\Controller::securityLoader() 
     * pour charger la couche securité afin de l'injecter dans l'objet response gerant l'affichage.
     */
    function __construct()
    {
        parent::__construct();
    }



    /**
     * Cette methode simule la verification du client
     * Affichage des informations du token pour s'assurer de l'identité. 
     *  
     * A tester apres s'etre connecté et a pres s'etre déconnecté afin de voir le comportement.
     * 
     * @link /token URI definie dans le fichier config/routing.json     * 
     * 
     */
    public function token()
    {
        var_dump($this->security->acceptConnexion());
    }

    /* Les methodes suivantes correspondent aux URI de test qui gèrent les verbes HTTP */

    /** 
     * Exemple d'utilisation avec la superglobale $_GET
     * 
     * @see Controller::inputGet() retourne la superglobale $_GET
     * 
     * @example /api/default/?test=petitMessage&key=valeur2 avec cette URI la methode retourne un tableau associatif correspondant aux données passées en arguments à l'URL
     */
    public function getDatasFromGET()
    {
        var_dump($this->inputGet());
    }

    /** 
     * Exemple d'utilisation avec la superglobale $_POST
     * 
     * @see Controller::inputPost() retourne la superglobale $_POST
     * 
     * @example /api/default ajouter dans le corps de la requete des données au format : x-www-form-urlencoded
     */
    public function getDatasFromPOST()
    {
        var_dump($this->inputPost());
    }

    /** 
     * Exemple d'utilisation avec la mise a jour d'une ressource via la methode PUT 
     * 
     * @see Controller::inputPut() retourne les données sous la forme d'un tableau associatif 
     * 
     * @example /api/default ajouter dans le corps de la requete des données au format : x-www-form-urlencoded
     */
    public function getDatasFromPUT()
    {
        var_dump($this->inputPut());
    }

    /** 
     * Ici la methode sera invoquée lors d'une requête HTTP dont le verbe est DELETE. 
     * L'exemple retourne les données des propriétés put, post et get. 
     * 
     * N'hésitez pas tester !
     */
    public function delete()
    {
        var_dump($this->inputPut());
        var_dump($this->inputPost());
        var_dump($this->inputGet());
    }

    /**
     * La methode affiche les données variables de l'URI comme definies dans le fichier routing.json. 
     * 
     * 
     * @param type $value correspond a la partie variable de l'URI dont le pattern est : (:).
     * 
     * @example /api/default/bonjour retournera bonjour. 
     * @example /api/default/32 retournera 32. 
     */
    public function getByValue($value)
    {
        echo "valeur passée dans l'uri : " . $value;
    }



    public function test()
    {
        $r = new \BWB\Framework\mvc\Request();
        var_dump($r->post(TestModel::class));
        var_dump($r->put(TestModel::class));
    }

    public function getViewFiles()
    {
        $this->render("form-upload");
    }
    public function uploadFiles()
    {
        var_dump($_FILES);

    }

    public function getJSON()
    {
        $this->response->sendJSON(array(
            "toto" => "tata"
        ));
    }


    //Affiche la vue des shipments
    public function renderList(){

        $datas = array();

        $offset = isset($_GET["offset"]) ? $_GET["offset"] : 0;

        $dels =  (new DAOFlux())->getCurrentDeliveries($offset);

        foreach($dels as $del){
      
      
            array_push($datas, (new DAOFlux())->getDeliveryInfo($del["id"]));
        }

        include ("./views/head.php");
        include ("./views/sidebar.php");
        $this->render("FluxList",array("data"=>$datas ));
        
        $this->render("pagination",array(
        "totalToLoad"=>(new DAOFlux)->getMaxDeliveries()));
    }

    //Affiche la vue 
    public function renderDetail(){

        $currentId = end(explode("/", $_SERVER["REQUEST_URI"]));

        include ("./views/head.php");
        include ("./views/sidebar.php");

        $this->render("FluxDetail",array(
        "path"=>((new DAOFlux())->getDeliveryPath($currentId)),
        "products"=>((new DAOFlux())->getDeliveryProducts($currentId))));
    }

}
