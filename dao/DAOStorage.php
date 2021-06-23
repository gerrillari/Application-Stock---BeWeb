<?php

namespace BWB\Framework\mvc\dao;
use BWB\Framework\mvc\DAO;
use pdo;

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

    public function getNameStorage($StorageID) {
        return $this->getPdo()->query(
            "SELECT name 
            FROM storage 
            WHERE id={$StorageID}"
            )->fetchAll();

    }

    public function getAdressStorage($StorageID) {
        return $this->getPdo()->query(
            "SELECT adress.city, adress.zipcode, adress.number, adress.street 
            FROM adress 
            INNER JOIN storage 
            ON adress.id = storage.id 
            WHERE storage.id={$StorageID}"
            )->fetchAll();
    }

    public function getStatutStorage($StorageID) {

            $sizeStorage=$this->getPdo()->query(
            "SELECT sizelimit FROM storage WHERE id={$StorageID}"
            )->fetchAll();
            $size=array_sum($sizeStorage);
       
            $getStockStorage=$this->getPdo()->query(
            "SELECT SUM(item_storage.quantity * product.size)            
            FROM item_storage 
            INNER JOIN item ON item_storage.itemid = item.id 
            INNER JOIN product ON item.productid = product.id 
            WHERE storageid={$StorageID}"
            )->fetchAll();
            $Stock=array_sum($getStockStorage);

            $getDeliveryStorage= $this->getPdo()->query(
            "SELECT SUM(shipment_item.quantity * product.size) FROM shipment_item
            INNER JOIN item ON shipment_item.itemid = item.id 
            INNER JOIN product ON item.productid = product.id
            INNER JOIN shipment ON shipment_item.shipmentid = shipment.id
            WHERE shipment.dateend <= curdate() AND shipment.destination = {$StorageID}"
            )->fetchAll();
            $Delivery=array_sum($getDeliveryStorage);

            $getCommandStorage= $this->getPdo()->query(
            "SELECT SUM(command_item_storage.quantity * product.size) FROM command_item_storage
            INNER JOIN item ON command_item_storage.itemid = item.id 
            INNER JOIN product ON item.productid = product.id
            INNER JOIN command ON command_item_storage.commandid = command.id
            WHERE command.dateend <= curdate() AND command_item_storage.storageid = {$StorageID}"
            )->fetchAll();
            
            $Command=array_sum($getCommandStorage);

            $Statut = ($Stock + $Delivery - $Command) / $size;

            return $Statut;
    }

    public function getStockStoragePercentage($StorageID) {

    }

    public function getDeliveryStoragePercentage($StorageID) {

    }

    public function getCommandStoragePercentage($StorageID) {

    }

    public function getQuantityProductStorage($StorageID,$ProductID) {

    }

    public function getSizeProductStorage($StorageID,$ProductID) {

    }

    public function getProduct($StorageID,$ProductID) {

    }

    public function getStockProductStorage($StorageID,$ProductID) {

    }

    public function getStockFluxProductStorage($StorageID,$ProductID) {

    }

    public function getDeliveryProductStorage($StorageID,$ProductID) {

    }

    public function getCommandProductStorage($StorageID,$ProductID) {

    }

    public function getStockProductStoragePercentage($StorageID,$ProductID) {

    }

    public function getDeliveryProductStoragePercentage($StorageID,$ProductID) {

    }

    public function getCommandProductStoragePercentage($StorageID,$ProductID) {

    }

    public function LocationStorage($StorageID) {
        
    }
}

//Code à mettre dans le storage.php afin d'afficher l'adresse complète concaténée 
    //$getAdress = AdressStorage($StorageID);
    //$getAdress["number"]." ".$getAdress["street"]." ".$getAdress["zipcode"]." ".$getAdress["city"];