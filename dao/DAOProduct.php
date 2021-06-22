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
    private function getProductStock($idProduct){

        return $this->getPdo()->query("SELECT quantity FROM item WHERE id = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Update la colonne treshold en base de donnée, elle correspondant au seuil de notification.
     */
    private function setProductTreshold($idProduct, $value){

        return $this->getPdo()->query("UPDATE item SET threshold = '${value}' WHERE id = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retourne toute les informations nécessaire a l'affichasge d'un produit.
     */
    public function getProducts(){

        #infos classic
        return $this->getPdo()->query("SELECT product.description, product.price, product.weight, product.name, item.quantity FROM item INNER JOIN product on item.productid = product.id ")->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Trouve le quantité d'un même article dans une livraison
     * Trouve le quantité d'un même article dans une commande
     */
    private function getProductsFlux($idProduct){

        $this->getPdo()->query("SELECT quantity FROM shipment_item WHERE itemid = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);

        $this->getPdo()->query("SELECT quantity FROM command_item_storage WHERE itemid = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);
    }
            


    /**
     * Retourn la quantité d'un produit (args) dans une entrepot (args)
     */
    private function getProductsFromStorage($idProduit, $idEntrepot){

        return $this->getPdo()->query("SELECT quantity FROM item_storage WHERE itemid = '${idProduct}' AND storageid = '${idEntrepot}' ")->fetchAll(PDO::FETCH_ASSOC);
    }
    

    /**
     * Trouve le stock livré d'un produit entre 2 dates passées en args
     * 
     * 
     * $datestart = chaine de caractere correspondant a une date 'YYYY-MM-DD'
     */
    private function getProductStockByDate($idProduct, $datestart = NULL, $dateend){

        #stock du produit
        $actualStock = getProductStock(idProduct);

        #s'il n'y a une date de début
        if($datestart == NULL){
            #CURDATE() = date courante 
            $shipmentQty = $this->getPdo()->query("SELECT quantity FROM shipment INNER JOIN shipment_item ON  '${dateend}' < CURDATE() WHERE itemid = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);

            $commandQty = $this->getPdo()->query("SELECT quantity FROM command INNER JOIN command_item_storage ON  '${dateend}' < CURDATE() WHERE itemid = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $shipmentQty = $this->getPdo()->query("SELECT quantity FROM shipment INNER JOIN shipment_item ON  '${dateend}' < $datestart WHERE itemid = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);

            $commandQty = $this->getPdo()->query("SELECT quantity FROM command INNER JOIN command_item_storage ON  '${dateend}' < CURDATE() WHERE itemid = '${idProduct}' ")->fetchAll(PDO::FETCH_ASSOC);
        }

         
    }


}