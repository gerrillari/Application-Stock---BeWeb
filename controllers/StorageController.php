<?
namespace BWB\Framework\mvc\controllers;

use BWB\Framework\mvc\Controller;
use BWB\Framework\mvc\models\DefaultModel;
use BWB\Framework\mvc\models\TestModel;

use BWB\Framework\mvc\dao\DAOStorage;
use \DateTime;
use Exception;

class StorageController extends Controller {
    public function getAllStorages(){

    

        $data = array(
            "storages"=>(new DAOStorage())->getNameStorage(),
            "adresses"=>(new DAOStorage())->getAllAdressStorage(),
            "status"=>(new DAOStorage())->getStatutStorage()
        );
        
        include ("./views/head.php");
        include ("./views/sidebar.php");
        $this->render("StoragesList",$data);
    }

    public function getStorage(){

        $currentid=end(explode("/",$_SERVER["REQUEST_URI"]));
        /**
         * décrémente 5 fois la date du jour de 1 mois
         */
        $dates = array();
        for ($i=0; $i < 10 ; $i+=2) { 
            array_push($dates,(new DateTime())->modify(-$i.' month')->format('Y-m-d'));
        }

        /**
         * Pour chacune des dates je les mets en clé du tableau DatePointset, met son stock en valeur
         * exemple de résultat [YYYY-MM-DD] => '600' (stock par rapport la date en clé);
         */
        $datePoints = array();
        foreach ($dates as $date){
            $datePoints[$date] = (new DAOStorage())->getStockStorageByDate($currentid,$date);
        }
        
        $data = array(
            #$psd = tableau de date en clé
            "psd" => $datePoints,
            "products"=>(new DAOStorage())->getInfoProductStorage($currentid),
            "bars"=>(new DAOStorage())->getStatutProductStorage($currentid)
            // "products"=>(new DAOStorage())->getInfoProductStorage(2),
            // "bars"=>(new DAOStorage())->getStatutProductStorage(2)
        );

        include ("./views/head.php");
        include ("./views/sidebar.php");
        $this->render("StorageDetail",$data);
    }
}