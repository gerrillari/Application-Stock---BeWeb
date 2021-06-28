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

    public function renderDashboard(){

        $data = array(
            "prodsThresh" => (new DAOProduct)->getProductThresh()
        );
        include ("./views/head.php");
        include ("./views/sidebar.php");
        $this->render("dashboard", $data);
    }
}
