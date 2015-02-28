<?php

namespace Application\Controllers;

/**
 *
 *
 */
class ListProduits extends \Library\Controller\Controller {
    
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
    *  Méthode post($params)
    *
    *  Crée une recette avec les paramètres de la requête POST       
    *  @param      array       $params     [données de requête]
    *  @return     array
    *
    */
    public function getListProduit($params) {
        unset($params['method']);



        $modelListProduit  = new \Application\Models\ListProduits('localhost');
        $res=$modelListProduit->fetchAll(" `id_recette`='{$params['id_recette']}' ");
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des produit");
        }


    }



    public function insertListProduits($params) {

        unset($params['method']);
        //var_dump($params);

        $modelListProduit  = new \Application\Models\ListProduits('localhost');
        
        $res=$modelListProduit->insert($params);
            
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
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function updateListProduit($params) {         //ajouter une recette


        unset($params['method']);

        //var_dump();
        $modelListProduit  = new \Application\Models\ListProduit('localhost');

        if($modelListProduit->update(" `id_produit`='{$params['id_produit']}' ", $params) ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la mise a jour");
        }
    }

    /**
     *  Méthode post($params)
     *
     *  Crée une recette avec les paramètres de la requête POST
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function deleteListProduit($params) {         //delete une recette


        unset($params['method']);

        $modelListProduit  = new \Application\Models\ListProduit('localhost');


        if($modelListProduit->delete(" `id_produit`='{$params['id_produit']}' ") ) {

            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression des produit");
        }
    }
}