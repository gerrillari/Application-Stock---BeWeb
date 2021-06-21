<?php
class StorageModel{

    public function getNameStorage($StorageID) {
        return $this->pdo->query(
            "SELECT name 
            FROM storage 
            WHERE id={$StorageID}"
            )->fetchAll();

    }

    public function getAdressStorage($StorageID) {
        return $this->pdo->query(
            "SELECT adress.city, adress.zipcode, adress.number, adress.street 
            FROM adress 
            INNER JOIN storage 
            ON adress.id = storage.id 
            WHERE storage.id={$StorageID}"
            )->fetchAll();
    }

    //????
    public function getStatutStorage($StorageID) {
        return $this->pdo->query(
            "SELECT SUM(item_storage.quantity * product.size) as capacity 
            FROM item_storage 
            INNER JOIN item ON item_storage.itemid = item.id 
            INNER JOIN product ON item.productid = product.id 
            WHERE storageid={$StorageID}"
            )->fetchAll();
    }

    public function getStockStorage($StorageID) {
        return $this->pdo->query(
            "SELECT SUM(item_storage.quantity) 
            FROM item_storage 
            WHERE storageid={$StorageID}"
            )->fetchAll();

    }

    public function getStockFluxStorage($StorageID) {

    }

    public function getDeliveryStorage($StorageID,$date) {

    }

    public function getCommandStorage($StorageID,$date) {

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
    $getAdress = AdressStorage($StorageID);
    $getAdress["number"]." ".$getAdress["street"]." ".$getAdress["zipcode"]." ".$getAdress["city"];