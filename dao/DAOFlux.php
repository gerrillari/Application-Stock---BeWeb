<?php
namespace BWB\Framework\mvc\dao;
use BWB\Framework\mvc\DAO;

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

    return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
   
}


/**
 * Retourne le nom et l'adresse de l'entrepôt d'origine et de destination de la livraison
 * dont l'id correspond a l'id passé, ainsi que la taille, le poids et la quantité des produits 
 * présent dans la livraison
*/

 function getDeliveryInfo($deliveryID){

        $query = "  SELECT storage.name, adress.city, adress.zipcode, adress.street, adress.number,
        shipment_item.quantity, product.size, product.weight 
        FROM shipment_item
        INNER JOIN shipment ON shipment.id = {$deliveryID}
        INNER JOIN storage ON storage.id = shipment.origin OR storage.id = shipment.destination
        INNER JOIN adress ON adress.id = storage.location
        INNER JOIN item ON item.id = shipment_item.itemid
        INNER JOIN product ON product.id = item.productid
        WHERE shipment_item.shipmentid = {$deliveryID}";

        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
 }


/**
 * Retourne le nom et l'adresse de l'entrepôt d'origine et de destination,
 * ainsi que la date de départ et la date de fin de la liraison
*/

function getDeliveryPath($deliveryID){
    $query = "  SELECT storage.name, adress.city, adress.zipcode, adress.street, adress.number,
    shipment_item.quantity, product.size, product.weight 
    FROM shipment_item
    INNER JOIN shipment ON shipment.id = {$deliveryID}
    INNER JOIN storage ON storage.id = shipment.origin OR storage.id = shipment.destination
    INNER JOIN adress ON adress.id = storage.location
    INNER JOIN item ON item.id = shipment_item.itemid
    INNER JOIN product ON product.id = item.productid
    WHERE shipment_item.shipmentid = {$deliveryID}";

    return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Met à jour l'adresse de l'entrepôt d'origine et de destination
 */

function updateDeliveryPath($deliveryID, $newOrigin, $newDestination){

}

/**
 * Retourne l'id, le nom, l'adresse de tout les entrepôt différents de celui 
 * dont l'id est fourni ainsi que la quantité, le poinds et la taille de tout les objets
 * présent pour chacun de ces entrepôts
*/

 function getAviableStorages($deliveryID){

 }

/**
 *   Retourne l'id, la quantité, le poids, la taille, le nom et la description
 *   de chaque produit dans cette livraison
*/
 function getDeliveryProducts($deliveryID){

 }

}
