<?php

namespace BWB\Framework\mvc\dao;
use BWB\Framework\mvc\DAO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DAODefault
 *
 * @author loic
 */
class DAODefault extends DAO{
    //put your code here

    public function __construct(){
        parent::__construct();
    }

    public function create($array) {
        
    }

    public function delete($id) {
        
    }

    public function getAll(): array{
        return $this->pdo->query("SELECT * FROM storage")->fetchAll();
    }

    public function getAllBy($filter) {
        
    }

    public function retrieve($id) {
        
    }

    public function update($array) {
        
    }

}
