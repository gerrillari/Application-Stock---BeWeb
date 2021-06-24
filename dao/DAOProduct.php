<?
namespace BWB\Framework\mvc\dao;
use BWB\Framework\mvc\DAO;
use PDO;

class DAOProduct extends DAO {

    public function __construct(){
        parent::__construct();
    }  


    #functions abtraite a implémenter pour utilisé le DAO
    public function create($array){

    }
    
    public function retrieve($id){

    }
    
    public function update($array){

    }
    
    public function delete($id){
        
    }

    public function getAll(){

    }
    
    public function getAllBy($filter){

    }


    /**
     * Retourne le stock du produit passé en argument.
     */
    public function getProductStock($idProduct){

        return $this->getPdo()->query("SELECT quantity FROM item WHERE id = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Update la colonne treshold en base de donnée, elle correspondant au seuil de notification.
     */
    public function setProductTreshold($idProduct, $value){

        return $this->getPdo()->query("UPDATE item SET threshold = '${value}' WHERE id = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retourne toute les informations nécessaire a l'affichasge d'un produit.
     */
    public function getProducts(){

        #infos classic
        return $this->getPdo()->query("SELECT  product.id, product.size, product.description, product.price, product.weight, product.name, item.quantity FROM item INNER JOIN product on item.productid = product.id ")->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Retourn les informations nécessaire a l'affichage d'une card storage.
     */
    public function getStorageInfo($idStorage){

        return $this->getPdo()->query("SELECT name, city, zipcode, street, number FROM storage INNER JOIN adress on adress.id = storage.location WHERE storage.id = '${idStorage}' ")->fetch();
    }

    /**
     * Trouve le quantité d'un même article dans une livraison
     * Trouve le quantité d'un même article dans une commande
     */
    public function getProductsFlux($idProduct){

        $this->getPdo()->query("SELECT quantity FROM shipment_item WHERE itemid = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);

        $this->getPdo()->query("SELECT quantity FROM command_item_storage WHERE itemid = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);
    }
            


    /**
     * Retourn la quantité d'un produit (args) des entrepots
     */
    public function getProductsFromStorage($idProduct){

        return $this->getPdo()->query(
            "SELECT item_storage.quantity, adress.city, adress.zipcode, adress.street, adress.number, storage.name FROM item_storage 
                INNER JOIN storage ON item_storage.storageid = storage.id 
                INNER JOIN adress ON storage.location = adress.id 
            WHERE itemid = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);
    }
    

    /**
     * Trouve le stock livré d'un produit entre 2 dates passées en args
     * 
     * 
     * $datestart = chaine de caractere correspondant a une date 'YYYY-MM-DD'
     */
    public function getProductStockByDate($idProduct, $date){

        #stock produit
        $actualStock = $this->getPdo()->query("SELECT item.quantity FROM item INNER JOIN product on item.productid = product.id ")->fetchAll(PDO::FETCH_ASSOC); 
        #calculer chaque element du tableaux
        $resultStock = array();

        foreach ($actualStock as $stock) {
            foreach ($stock as $i => $value) {
                $resultStock[$i]+=$value;

            }
        }
        

     

        $shipmentQty = $this->getPdo()->query("SELECT shipment_item.quantity FROM shipment_item INNER JOIN shipment ON shipment.dateend > '${date}' WHERE shipment_item.itemid = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);
        #calculer chaque element du tableaux
        $resultShipment = array();

        foreach ($shipmentQty as $shipment) {
            foreach ($shipment as $i => $value) {
                $resultShipment[$i]+=$value;

            }
        }

        $commandQty = $this->getPdo()->query("SELECT command_item_storage.quantity FROM command_item_storage INNER JOIN command ON command.dateend > '${date}' WHERE command_item_storage.itemid = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);
        #calculer chaque element du tableaux
        $resultComand = array();

        foreach ($commandQty as $command) {
            foreach ($command as $i => $value) {
                $resultComand[$i] += $value;

            }
        }

        $flux_entrant = $resultStock['quantity'] - $resultShipment['quantity'];
        $flux_sortant = $resultStock['quantity'] + $resultShipment['quantity'];
        var_dump($flux_entrant);
        var_dump($flux_sortant);
        var_dump($date);

      return array($flux_entrant, $flux_sortant, $date);

    }
}