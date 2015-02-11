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


    /**
     *  Méthode getingredients
     *
     *  retourne les ingredients
     *       
     *  @return     array
     *
     */
    public function getingredients() {




        $modelIngredient  = new \Application\Models\Ingredient('localhost');
        $res=$modelIngredient->getIngredients();
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des ingredients");
        }


    }




}