<?php
namespace BWB\Framework\mvc\dao;
use BWB\Framework\mvc\DAO;
use PDO;

/**
 * Ce DAO remonte les information liées aux flux de produits a travres len entrepôts
 */


class DAOFlux extends DAO{

/**
 * Retourne l'id, l'origin, le poids limit,  
 * la taille limit et la date de commencement de toute les livraison non finit
 **/ 

function getCurrentDeliveries(){

    $query = "SELECT id, origin, sizelimit, weightlimit, datestart 
              FROM shipment
              WHERE dateend IS NULL";

    return $this->getPdo()->query($query)->fetchAll(PDO::FETCH_ASSOC);
   
}


/**
 * Retourne le nom et l'adresse de l'entrepôt d'origine et de destination de la livraison
 * dont l'id correspond a l'id passé, ainsi que la taille, le poids et la quantité des produits 
 * présent dans la livraison
*/

 function getDeliveryInfo($deliveryID){

        $query = "SELECT storage.name, adress.city, adress.zipcode, adress.street, adress.number,
        shipment_item.quantity, product.size, product.weight 
        FROM shipment_item
        INNER JOIN shipment ON shipment.id = {$deliveryID}
        INNER JOIN storage ON storage.id = shipment.origin OR storage.id = shipment.destination
        INNER JOIN adress ON adress.id = storage.location
        INNER JOIN item ON item.id = shipment_item.itemid
        INNER JOIN product ON product.id = item.productid
        WHERE shipment_item.shipmentid = {$deliveryID}";

        return $this->getPdo()->query($query)->fetchAll(PDO::FETCH_ASSOC);
 }


/**
 * Retourne le nom et l'adresse de l'entrepôt d'origine et de destination,
 * ainsi que la date de départ et la date de fin de la livraison
*/

function getDeliveryPath($deliveryID){
    $query = "SELECT storage.name, adress.city, adress.zipcode, adress.street, adress.number,
    shipment.datestart, shipment.dateend
    FROM shipment
    INNER JOIN storage ON storage.id = shipment.origin OR storage.id = shipment.destination
    INNER JOIN adress ON adress.id = storage.location
    WHERE shipment.id = {$deliveryID}";

    return $this->getPdo()->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Met à jour l'adresse d'origin et de destination d'une livraison
 */

function updateDeliveryPath($deliveryID, $newOrigin, $newDestination){

    $query = "UPDATE shipment
    SET origin = {$newOrigin}, destination = {$newDestination}
    WHERE shipment.id = {$deliveryID}";

    return $this->getPdo()->query($query)->fetchAll(PDO::FETCH_ASSOC);

}

/**
 * Retourne l'id, le nom, l'adresse de tout les entrepôt différents de celui 
 * dont l'id est fourni ainsi que la quantité, le poinds et la taille de tout les objets
 * présent pour chacun de ces entrepôts
*/

 function getAviableStorages($storageID){

    $query = "SELECT storage.id, storage.name,  adress.city, adress.zipcode, adress.street,
    adress.number, item_storage.itemid, item_storage.quantity, product.size, product.weight
    FROM item_storage
    INNER JOIN storage on storage.id = {$storageID}
    INNER JOIN adress on adress.id = storage.location
    INNER JOIN item on item.id = item_storage.itemid
    INNER JOIN product on product.id = item.productid
    WHERE item_storage.storageid = {$storageID}";

    return $this->getPdo()->query($query)->fetchAll(PDO::FETCH_ASSOC);

 }

/**
 *   Retourne l'id, la quantité, le poids, la taille, le nom et la description
 *   de chaque produit dans cette livraison
*/
 function getDeliveryProducts($deliveryID){

    $query = "SELECT item.id, shipment_item.quantity, product.weight, product.size,
    product.name, product.description
    FROM shipment_item
    INNER JOIN item ON item.id = shipment_item.itemid
    INNER JOIN product ON product.id = item.productid
    WHERE shipment_item.shipmentid = {$deliveryID}";

    return $this->getPdo()->query($query)->fetchAll(PDO::FETCH_ASSOC);
 }

 public function create($array) {
        
}

public function delete($id) {
    
}

public function getAll() {
    
}

public function getAllBy($filter) {
    
}

public function retrieve($id) {
    
}

public function update($array) {
    
}

}

