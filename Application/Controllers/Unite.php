<?php

namespace Application\Controllers;

/**
 *
 *
 */
class Unite extends \Library\Controller\Controller {
    
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
     *  Méthode getcategories
     *
     *  retourne les categories
     *       
     *  @return     array
     *
     */
    public function getunites() {




        $modelUnite  = new \Application\Models\Unite('localhost');
        $res=$modelUnite->getUnites();
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des Unites");
        }


    }




}