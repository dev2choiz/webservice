<?php

namespace Application\Controllers;

/**
 *
 *
 */
class Produit extends \Library\Controller\Controller {
    
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
    public function getAllProduits() {

        $modelProduit  = new \Application\Models\Produit('localhost');
        $res=$modelProduit->fetchAll();
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des produit");
        }

    }

    public function getProduit($params) {
        unset($params['method']);



        $modelProduit  = new \Application\Models\Produit('localhost');
        $res=$modelProduit->fetchAll(" `id_produit`='{$params['id_produit']}' ");
        var_dump($res);
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des produit");
        }


    }



    public function insertProduit($params) {

        unset($params['method']);
        //var_dump($params);

        $modelProduit  = new \Application\Models\Produit('localhost');
        
        $res=$modelProduit->insert($params);
            
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
    public function updateProduit($params) {         //ajouter une recette


        unset($params['method']);

        //var_dump();
        $modelProduit  = new \Application\Models\Produit('localhost');

        if($modelProduit->update(" `id_produit`='{$params['id_produit']}' ", $params) ) {
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
    public function deleteProduit($params) {         //delete une recette


        unset($params['method']);

        $modelProduit  = new \Application\Models\Produit('localhost');


        if($modelProduit->delete(" `id_produit`='{$params['id_produit']}' ") ) {

            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression des produit");
        }
    }
}