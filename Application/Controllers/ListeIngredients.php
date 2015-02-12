<?php

namespace Application\Controllers;

/**
 *
 *
 */
class ListeIngredients extends \Library\Controller\Controller {
    
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
        $modelListeIngredients  = new \Application\Models\ListeIngredients('localhost');

        //var_dump($params);
        
        $res=$modelListeIngredients->InsertListeIngredients($params);
            
        if($res ) {
            return $this->setApiResult( true );
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des ingredients");
        }


    }



}