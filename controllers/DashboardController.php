<?php

namespace BWB\Framework\mvc\controllers;

use BWB\Framework\mvc\Controller;
use BWB\Framework\mvc\models\DefaultModel;
use BWB\Framework\mvc\models\TestModel;
use BWB\Framework\mvc\dao\DAOProduct;
use Exception;

class DashboardController extends Controller {


    public function __construct(){
        parent::__construct();
    }

    /**
     * Renvoie la vu du dashboard
     */
    public function renderDashboard(){
        if( (new DAOProduct())->getProductThresh() != NULL ){
            $data = array(
                "prodsThresh" => (new DAOProduct())->getProductThresh()
            );
            include ("./views/head.php");
            include ("./views/sidebar.php");
            $this->render("dashboard", $data);
            
        }else{
            $this->renderEmptyDashboard();
        }


    }

    /**
     * Renvoie la page dashboard s'il n'y a pas de produit sous le seuil
     */
    public function renderEmptyDashboard(){

        include ("./views/head.php");
        include ("./views/sidebar.php");
        
        $this->render("emptyDashboard");

    }
}
