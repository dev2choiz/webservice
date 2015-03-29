<?php

namespace Application\Controllers;

/**
 *
 *
 */
class ViewListProduits extends \Library\Controller\Controller {
    
    /**
     *  MÃ©thode __construct()
     *
     *  Constructeur par dÃ©faut appelant le constructeur de Library\Controller\Controller
     *
     */
    public function __construct() {
        parent::__construct();
    }


    /**
    *  MÃ©thode post($params)
    *
    *  CrÃ©e une recette avec les paramÃ¨tres de la requÃªte POST       
    *  @param      array       $params     [donnÃ©es de requÃªte]
    *  @return     array
    *
    */
   public function getViewListProduitsByProduit($params) {
        unset($params['method']);



        $modelViewListProduit  = new \Application\Models\ViewListProduits('localhost');
        $res = $modelViewListProduit->fetchAll(" `id_produit`={$params['id_produit']} ");
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des produit");
        }


    }

    /**
    *  Méthode post($params)
    *
    *  Crée une recette avec les paramètres de la requête POST       
    *  @param      array       $params     [données de requête]
    *  @return     array
    *
    */
    public function getViewListProduitsByRecette($params) {
        unset($params['method']);



        $modelViewListProduit  = new \Application\Models\ViewListProduits('localhost');
        $res = $modelViewListProduit->fetchAll(" `id_recette`={$params['id_recette']} ");
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des produit");
        }


    }

}	