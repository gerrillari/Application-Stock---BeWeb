<?

namespace BWB\Framework\mvc\controllers;
use BWB\Framework\mvc\Controller;
use \Datetime;

use BWB\Framework\mvc\dao\DAOProduct;
use Exception;


class ProductController extends Controller {

    public function __construct(){
        parent::__construct();
    }

    /**
     * Renvoie ma list de produit avec les data correspondantes
     */
    public function renderList(){
        #récupère le derniere element demon uri 
        #exemple : '/product/1' => je récup 1
        $currentid = end(explode("/", $_SERVER["REQUEST_URI"]));
    
        $data = array(
            "products" => (new DAOProduct())->getProducts(),

        );
        $this->render("ViewProductList", $data);
    }
    
    /**
     * Renvoie mes details des produits avec les data correspondantes
     */
    public function renderDetails($currentid){
        #calcule de l'id courant
        $currentid = end(explode("/", $_SERVER["REQUEST_URI"]));
        
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
            $datePoints[$date] = (new DAOProduct())->getProductStockByDate($currentid, $date);
        }

        #render ma vue
        $data = array(
            #$psd = tableau de date en clé
            "psd" => $datePoints,
            "storages" => (new DAOProduct())->getStorageInfo($currendid)
        );
        $this->render("ViewProductDetails", $data);
    }

    public function updateDetails(){
        $currentid = end(explode("/", $_SERVER["REQUEST_URI"]));

        (new DAOProduct())->setProductTreshold($currentid, $_POST['threshold']);
        $this->renderDetails($currentid);
    }
}