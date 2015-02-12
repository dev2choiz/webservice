<?php

namespace Application\Controllers;

/**
 *
 *
 */
class Ingredient extends \Library\Controller\Controller {
    
    /**
     *  Méthode __construct()
     *
     *  Constructeur par défaut appelant le constructeur de Library\Controller\Controller
     *
     */
    public function __construct() {
        parent::__construct();
    }


    public function insertlisteingredients($params) {

        unset($params['method']);
        $modelListeIngredient  = new \Application\Models\ListeIngredient('localhost');

        //var_dump($params);
        
        $res=$modelListeIngredient->InsertListeIngredients($params);
            
        if($res ) {
            return $this->setApiResult( true );
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des ingredients");
        }


    }



}