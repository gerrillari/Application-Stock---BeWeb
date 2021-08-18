<?php

namespace BWB\Framework\mvc\dao;
use BWB\Framework\mvc\DAO;
use PDO;

class DAOStorage extends DAO {

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
     * Retourne le nom et l'id de l'entrepôt
     */
    public function getNameStorage() {
        return $this->getPdo()->query(
            "SELECT id,name 
            FROM storage"
            )->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Retourne l'adresse (ville, code postal, numéro et rue) d'un entrepôt en particulier
     */
    public function getAdressStorage($StorageID) {
        return $this->getPdo()->query(
            "SELECT adress.city, adress.zipcode, adress.number, adress.street 
            FROM adress 
            INNER JOIN storage 
            ON adress.id = storage.location 
            WHERE storage.id={$StorageID}"
            )->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retourne l'adresse (ville, code postal, numéro et rue) de tous les entrepôts
     */
     public function getAllAdressStorage() {
        return $this->getPdo()->query(
            "SELECT adress.city, adress.zipcode, adress.number, adress.street 
            FROM adress"
            )->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retourne la taille de l'entrepôt, la quantité de stock/livraison/commande et sa taille totale par entrepôt
     * et calcule le stock total tenant compte le stock actuel, le flux entrant et sortant
     */
    public function getStatutStoragebyID($StorageID) {

            $sizeStorage=$this->getPdo()->query(
            "SELECT sizelimit FROM storage WHERE id={$StorageID}"
            )->fetchAll(PDO::FETCH_ASSOC);
            $size=array_sum($sizeStorage);
       
            $getStockStorage=$this->getPdo()->query(
            "SELECT SUM(item_storage.quantity * product.size)            
            FROM item_storage 
            INNER JOIN item ON item_storage.itemid = item.id 
            INNER JOIN product ON item.productid = product.id 
            WHERE storageid={$StorageID}"
            )->fetchAll(PDO::FETCH_ASSOC);
            $Stock=array_sum($getStockStorage);

            $getDeliveryStorage= $this->getPdo()->query(
            "SELECT SUM(shipment_item.quantity * product.size) 
            FROM shipment_item
            INNER JOIN item ON shipment_item.itemid = item.id 
            INNER JOIN product ON item.productid = product.id
            INNER JOIN shipment ON shipment_item.shipmentid = shipment.id
            WHERE shipment.dateend <= curdate() AND shipment.destination = {$StorageID}"
            )->fetchAll(PDO::FETCH_ASSOC);
            $Delivery=array_sum($getDeliveryStorage);

            $getCommandStorage= $this->getPdo()->query(
            "SELECT SUM(command_item_storage.quantity * product.size) 
            FROM command_item_storage
            INNER JOIN item ON command_item_storage.itemid = item.id 
            INNER JOIN product ON item.productid = product.id
            INNER JOIN command ON command_item_storage.commandid = command.id
            WHERE command.dateend <= curdate() AND command_item_storage.storageid = {$StorageID}"
            )->fetchAll(PDO::FETCH_ASSOC);
            $Command=array_sum($getCommandStorage);

            $Statut = (($Stock + $Delivery - $Command) / $size)*100;

            return $Statut;
    }

    /**
     *Retourne la taille de l'entrepôt, la quantité de stock/livraison/commande et sa taille totale
     */
    public function getStatutStorage() {

            return $this->getPdo()->query(
                "SELECT item_storage.storageid, storage.sizelimit as sizestorage, item_storage.quantity as stock, shipment_item.quantity as delivery, command_item_storage.quantity as command, product.size as sizeproduct
                FROM item_storage
                INNER JOIN storage ON storage.id = item_storage.storageid
                INNER JOIN shipment_item ON shipment_item.itemid = item_storage.itemid
                INNER JOIN command_item_storage ON command_item_storage.itemid = item_storage.itemid
                INNER JOIN item ON item.id = item_storage.itemid 
                INNER JOIN product ON product.id = item.productid"
                )->fetchAll(PDO::FETCH_ASSOC);
                
    }

    /**
     *Retourne les informations des produits d'un entrepôt comme le nom, sa description, sa quantité et taille
     */
    public function getInfoProductStorage($StorageID) {
        return $this->getPdo()->query(
            "SELECT product.name,product.description,
            (item_storage.quantity * product.size) as capacity,item_storage.quantity 
            FROM item_storage
            INNER JOIN item ON item_storage.itemid = item.id
            INNER JOIN product ON item.productid = product.id
            WHERE item_storage.storageid = '{$StorageID}'"
            )->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *Retourne la taille de l'entrepôt, la quantité de stock/livraison/commande et sa taille totale des produits d'un entrepôt
     */
    public function getStatutProductStorage($StorageID) {

            return $this->getPdo()->query(
                "SELECT storage.name, product.id as idp, item_storage.storageid, storage.sizelimit as sizestorage, item_storage.quantity as stock, shipment_item.quantity as delivery, command_item_storage.quantity as command, product.size as sizeproduct
                FROM item_storage
                INNER JOIN storage ON storage.id = item_storage.storageid
                INNER JOIN shipment_item ON shipment_item.itemid = item_storage.itemid
                INNER JOIN command_item_storage ON command_item_storage.itemid = item_storage.itemid
                INNER JOIN item ON item.id = item_storage.itemid 
                INNER JOIN product ON product.id = item.productid
                WHERE item_storage.storageid = '{$StorageID}'"
                )->fetchAll(PDO::FETCH_ASSOC);
                
    }

    /**
     * Retourne la quantité de stock/livraison/commande et la taille totale des produits par entrepôt
     * et une date en particulier 
     * et calcule le flux tenant compte le stock actuel, le flux entrant et sortant
     */
    public function getStockStorageByDate($StorageID,$date){
        $stocks = $this->getPdo()->query(
                "SELECT item_storage.quantity 
                FROM item_storage 
                WHERE item_storage.storageid='{$StorageID}'"
                )->fetchAll(PDO::FETCH_ASSOC);
        $resultstock;
        foreach ($stocks as $stock) {
                $resultstock += $stock["quantity"];
        }

        $deliverys = $this->getPdo()->query(
                "SELECT shipment_item.quantity, shipment.dateend
                FROM shipment_item
                INNER JOIN shipment ON shipment.id = shipment_item.shipmentid
                WHERE shipment.destination = '{$StorageID}' AND shipment.dateend <= '{$date}'"
                )->fetchAll(PDO::FETCH_ASSOC);
        $resultdelivery;
        foreach ($deliverys as $delivery) {
                $resultdelivery += $delivery["quantity"];
        }
        
        $commands = $this->getPdo()->query(
                "SELECT command_item_storage.quantity, command.dateend
                FROM command_item_storage
                INNER JOIN command ON command.id = command_item_storage.commandid 
                WHERE command_item_storage.storageid= '{$StorageID}' AND command.dateend <= '{$date}'"
                )->fetchAll(PDO::FETCH_ASSOC);
        $resultcommand;
        foreach ($commands as $command) {
                $resultcommand += $command["quantity"];
        }

        $flux = $resultstock - $resultdelivery + $resultcommand;

        return $flux;      
    }

    
}


