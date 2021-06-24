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

    public function getNameStorage() {
        return $this->getPdo()->query(
            "SELECT id,name 
            FROM storage"
            )->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getAdressStorage($StorageID) {
        return $this->getPdo()->query(
            "SELECT adress.city, adress.zipcode, adress.number, adress.street 
            FROM adress 
            INNER JOIN storage 
            ON adress.id = storage.location 
            WHERE storage.id={$StorageID}"
            )->fetchAll(PDO::FETCH_ASSOC);
    }

     public function getAllAdressStorage() {
        return $this->getPdo()->query(
            "SELECT adress.city, adress.zipcode, adress.number, adress.street 
            FROM adress"
            )->fetchAll(PDO::FETCH_ASSOC);
    }

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

    public function getStatutStorage() {

            $sizeStorage=$this->getPdo()->query(
            "SELECT id,sizelimit FROM storage"
            )->fetchAll(PDO::FETCH_ASSOC);
            //$size=array_sum($sizeStorage);
       
            $getStockStorage=$this->getPdo()->query(
            "SELECT SUM(item_storage.quantity * product.size)            
            FROM item_storage 
            INNER JOIN item ON item_storage.itemid = item.id 
            INNER JOIN product ON item.productid = product.id"
            )->fetchAll(PDO::FETCH_ASSOC);
            //$Stock=array_sum($getStockStorage);

            $getDeliveryStorage= $this->getPdo()->query(
            "SELECT SUM(shipment_item.quantity * product.size) 
            FROM shipment_item
            INNER JOIN item ON shipment_item.itemid = item.id 
            INNER JOIN product ON item.productid = product.id
            INNER JOIN shipment ON shipment_item.shipmentid = shipment.id
            WHERE shipment.dateend <= curdate()"
            )->fetchAll(PDO::FETCH_ASSOC);
            //$Delivery=array_sum($getDeliveryStorage);

            $getCommandStorage= $this->getPdo()->query(
            "SELECT SUM(command_item_storage.quantity * product.size) 
            FROM command_item_storage
            INNER JOIN item ON command_item_storage.itemid = item.id 
            INNER JOIN product ON item.productid = product.id
            INNER JOIN command ON command_item_storage.commandid = command.id
            WHERE command.dateend <= curdate()"
            )->fetchAll(PDO::FETCH_ASSOC);
            //$Command=array_sum($getCommandStorage);           

           //$Status = (($getStockStorage + $getDeliveryStorage - $getCommandStorage)/$sizeStorage )*100;

        var_dump($getStockStorage);
        var_dump($getDeliveryStorage);
        var_dump($getCommandStorage);
        //var_dump($sizeStorage);

            //return $Status;
    }

    public function getStockStoragePercentage() {
       
            $sizeStorage=$this->getPdo()->query(
            "SELECT sizelimit FROM storage"
            )->fetchAll(PDO::FETCH_ASSOC);
            $size=array_sum($sizeStorage);
       
            $getStockStorage=$this->getPdo()->query(
            "SELECT SUM(item_storage.quantity * product.size)            
            FROM item_storage 
            INNER JOIN item ON item_storage.itemid = item.id 
            INNER JOIN product ON item.productid = product.id "
            )->fetchAll(PDO::FETCH_ASSOC);
            $Stock=array_sum($getStockStorage);          

            $StockPercent = ($Stock/ $size)*100;      
           
            return $StockPercent;
    }

    public function getDeliveryStoragePercentage() {

            $sizeStorage=$this->getPdo()->query(
            "SELECT sizelimit FROM storage"
            )->fetchAll(PDO::FETCH_ASSOC);
            //$size=array_sum($sizeStorage);

            $getDeliveryStorage= $this->getPdo()->query(
            "SELECT SUM(shipment_item.quantity * product.size) 
            FROM shipment_item
            INNER JOIN item ON shipment_item.itemid = item.id 
            INNER JOIN product ON item.productid = product.id
            INNER JOIN shipment ON shipment_item.shipmentid = shipment.id
            WHERE shipment.dateend <= curdate()"
            )->fetchAll(PDO::FETCH_ASSOC);
            //$Delivery=array_sum($getDeliveryStorage);

            //$DeliveryPercent = ($getDeliveryStorage / $sizeStorage)*100;

            return $DeliveryPercent;
    }

    public function getCommandStoragePercentage() {

            $sizeStorage=$this->getPdo()->query(
            "SELECT sizelimit FROM storage"
            )->fetchAll(PDO::FETCH_ASSOC);
            $size=array_sum($sizeStorage);

            $getCommandStorage= $this->getPdo()->query(
            "SELECT SUM(command_item_storage.quantity * product.size) 
            FROM command_item_storage
            INNER JOIN item ON command_item_storage.itemid = item.id 
            INNER JOIN product ON item.productid = product.id
            INNER JOIN command ON command_item_storage.commandid = command.id
            WHERE command.dateend <= curdate()"
            )->fetchAll(PDO::FETCH_ASSOC);
            $Command=array_sum($getCommandStorage);

            $CommandPercent = ($Command / $size)*100;

            return $CommandPercent;
    }

    public function getStockStoragePercentagebyID($StorageID) {
       
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

            $StockPercent = ($Stock/ $size)*100;      
           
            return $StockPercent;
    }

    public function getDeliveryStoragePercentagebyID($StorageID) {

            $sizeStorage=$this->getPdo()->query(
            "SELECT sizelimit FROM storage WHERE id={$StorageID}"
            )->fetchAll(PDO::FETCH_ASSOC);
            $size=array_sum($sizeStorage);

            $getDeliveryStorage= $this->getPdo()->query(
            "SELECT SUM(shipment_item.quantity * product.size) 
            FROM shipment_item
            INNER JOIN item ON shipment_item.itemid = item.id 
            INNER JOIN product ON item.productid = product.id
            INNER JOIN shipment ON shipment_item.shipmentid = shipment.id
            WHERE shipment.dateend <= curdate() AND shipment.destination = {$StorageID}"
            )->fetchAll(PDO::FETCH_ASSOC);
            $Delivery=array_sum($getDeliveryStorage);

            $DeliveryPercent = ($Delivery / $size)*100;

            return $DeliveryPercent;
    }

    public function getCommandStoragePercentagebyID($StorageID) {

            $sizeStorage=$this->getPdo()->query(
            "SELECT sizelimit FROM storage WHERE id={$StorageID}"
            )->fetchAll(PDO::FETCH_ASSOC);
            $size=array_sum($sizeStorage);

            $getCommandStorage= $this->getPdo()->query(
            "SELECT SUM(command_item_storage.quantity * product.size) 
            FROM command_item_storage
            INNER JOIN item ON command_item_storage.itemid = item.id 
            INNER JOIN product ON item.productid = product.id
            INNER JOIN command ON command_item_storage.commandid = command.id
            WHERE command.dateend <= curdate() AND command_item_storage.storageid = {$StorageID}"
            )->fetchAll(PDO::FETCH_ASSOC);
            $Command=array_sum($getCommandStorage);

            $CommandPercent = ($Command / $size)*100;

            return $CommandPercent;
    }

    public function getInfoProductStorage($StorageID,$ProductID) {
        return $this->getPdo()->query(
            "SELECT product.name,product.description,(item_storage.quantity * product.size),item_storage.quantity 
            FROM item_storage
            INNER JOIN item ON item_storage.itemid = item.id
            INNER JOIN product ON item.productid = product.id
            WHERE item_storage.storageid = {$StorageID} AND product.id = {$ProductID}"
            )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStockProductStoragePercentage($StorageID,$ProductID) {
        $sizeStorage=$this->getPdo()->query(
            "SELECT sizelimit FROM storage WHERE id={$StorageID}"
            )->fetchAll(PDO::FETCH_ASSOC);
            $size=array_sum($sizeStorage);
       
            $getProductStockStorage=$this->getPdo()->query(
            "SELECT SUM(item_storage.quantity * product.size)            
            FROM item_storage 
            INNER JOIN item ON item_storage.itemid = item.id 
            INNER JOIN product ON item.productid = product.id 
            WHERE item_storage.storageid={$StorageID} AND item.productid = {$ProductID}"
            )->fetchAll(PDO::FETCH_ASSOC);
            $ProductStock=array_sum($getProductStockStorage);          

            $ProductStockPercent = ($ProductStock/ $size)*100;      
           
            return $ProductStockPercent;
    }

    public function getDeliveryProductStoragePercentage($StorageID,$ProductID) {
            $sizeStorage=$this->getPdo()->query(
            "SELECT sizelimit FROM storage WHERE id={$StorageID}"
            )->fetchAll(PDO::FETCH_ASSOC);
            $size=array_sum($sizeStorage);

            $getProductDeliveryStorage= $this->getPdo()->query(
            "SELECT SUM(shipment_item.quantity * product.size) FROM shipment_item
            INNER JOIN item ON shipment_item.itemid = item.id 
            INNER JOIN product ON item.productid = product.id
            INNER JOIN shipment ON shipment_item.shipmentid = shipment.id
            WHERE shipment.destination = {$StorageID} AND item.productid = {$ProductID}"
            )->fetchAll(PDO::FETCH_ASSOC);
            $ProductDelivery=array_sum($getProductDeliveryStorage);

            $ProductDeliveryPercent = ($ProductDelivery / $size)*100;

            return $ProductDeliveryPercent;
    }

    public function getCommandProductStoragePercentage($StorageID,$ProductID) {
            $sizeStorage=$this->getPdo()->query(
            "SELECT sizelimit FROM storage WHERE id={$StorageID}"
            )->fetchAll(PDO::FETCH_ASSOC);
            $size=array_sum($sizeStorage);

            $getProductCommandStorage= $this->getPdo()->query(
            "SELECT SUM(command_item_storage.quantity * product.size) FROM command_item_storage
            INNER JOIN item ON command_item_storage.itemid = item.id 
            INNER JOIN product ON item.productid = product.id
            INNER JOIN command ON command_item_storage.commandid = command.id
            WHERE command_item_storage.storageid = {$StorageID} AND item.productid = {$ProductID}"
            )->fetchAll(PDO::FETCH_ASSOC);
            $ProductCommand=array_sum($getProductCommandStorage);

            $ProductCommandPercent = ($ProductCommand / $size)*100;

            return $ProductCommandPercent;
    }

}

