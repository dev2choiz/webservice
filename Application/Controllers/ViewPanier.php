<?php

namespace Application\Controllers;

/**
 *
 * Panier
 */
class ViewPanier extends \Library\Controller\Controller {
    
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
     *  Méthode getpaniers
     *
     *  retourne les paniers
     *       
     *  @return     array
     *
     */
    public function getViewPanier($params) {         //ajouter une recette

        unset($params['method']);
        $param            = (empty($params["id_user"]))? null : ($params["id_user"]+0);
        
        var_dump($param);

        $modelPanier  = new \Application\Models\ViewPanier();
        $res = $modelPanier->findByPrimary($param);
        var_dump($res);
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des paniers");
        }


    }



}