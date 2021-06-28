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

        return $this->getPdo()->query("SELECT quantity, id FROM item WHERE id = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Update la colonne treshold en base de donnée, elle correspondant au seuil de notification.
     */
    public function setProductTreshold($idProduct, $value){
        return $this->getPdo()->query("UPDATE item SET threshold = '${value}' WHERE id = '${idProduct}' ");
    }

    /**
     * Retourne toute les informations nécessaire a l'affichasge d'un produit.
     */
    public function getProducts(){

        #infos classic
        return $this->getPdo()->query("SELECT item.id, product.description, product.price, product.weight, product.size, product.name, item.quantity FROM item INNER JOIN product on item.productid = product.id ")->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Retourn les informations nécessaire a l'affichage d'une card storage.
     */
    public function getStorageInfo($idProduct){

        return $this->getPdo()->query("SELECT storage.name, adress.city, adress.zipcode, adress.street, adress.number, item_storage.quantity FROM item_storage
                INNER JOIN storage ON storage.id = item_storage.storageid
                INNER JOIN adress ON adress.id = storage.location
            WHERE item_storage.itemid = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);
    }     


    /**
     * Trouve le stock livré d'un produit entre 2 dates passées en args
     * 
     * 
     * $datestart = chaine de caractere correspondant a une date 'YYYY-MM-DD'
     */
    public function getProductStockByDate($idProduct, $date){

        #stock produit
        $actualStock = $this->getPdo()->query("SELECT quantity FROM item WHERE id = '{$idProduct}' ")->fetchAll(PDO::FETCH_ASSOC); 

        $shipmentQty = $this->getPdo()->query(
            "SELECT shipment_item.quantity, shipment.dateend FROM shipment_item 
                INNER JOIN shipment ON shipment.id = shipment_item.shipmentid
            WHERE shipment_item.itemid = '${idProduct}' AND shipment.dateend < '${date}'"
            )->fetchAll(PDO::FETCH_ASSOC);
            
            #calculer chaque element du tableaux
            $resultShipment;
            
            foreach ($shipmentQty as $shipment) {
                $resultShipment += $shipment['quantity'];
            }
            
        $commandQty = $this->getPdo()->query(
            "SELECT command_item_storage.quantity, command.dateend FROM command_item_storage
                INNER JOIN command ON command.id = command_item_storage.commandid
            WHERE command_item_storage.itemid = '${idProduct}' AND command.dateend < '${date}' "
        )->fetchAll(PDO::FETCH_ASSOC);

        
        
        #calculer chaque element du tableaux
        $resultCommand;
        
        foreach ($commandQty as $command) {
            $resultCommand += $command['quantity'];
        }
        
    

        $flux = $actualStock[0]['quantity'] - $resultShipment + $resultCommand;


      return $flux;

    }

    public function getProductThresh(){
        return $this->getPdo()->query("SELECT item.id, product.description, product.price, product.weight, product.size, product.name, item.quantity FROM item INNER JOIN product on item.productid = product.id WHERE item.quantity <= item.threshold")->fetchAll(PDO::FETCH_ASSOC);
    }


    
}

