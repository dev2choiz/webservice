<?php

namespace Application\Controllers;

/**
 *
 *
 */
class ListProduit extends \Library\Controller\Controller {
    
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


        
        $modelListProduit  = new \Application\Models\ListProduit('localhost');
        $res=$modelListProduit->fetchAll(" `id_recette`='{$params['id_recette']}' ");
        
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des produit");
        }


    }



    public function insertListProduit($params) {

        unset($params['method']);

        $modelListProduit  = new \Application\Models\ListProduit('localhost');
        
        echo " `id_produit`={$params['id_produit']} AND  `id_recette`={$params['id_recette']} ";
        $res1= $modelListProduit->fetchAll(" `id_produit`={$params['id_produit']} AND  `id_recette`={$params['id_recette']} ") ;
        $res2= $modelListProduit->fetchAll(" `id_recette`={$params['id_recette']} ") ;
        //var_dump($res);
        
        if(empty($res1) && count($res2)>2){
            return $this->setApiResult(false, true, "le produit est deja sur la liste ou il ya deja 3 produits");
        }


        $res=$modelListProduit->insert($params);
            
        if(  $res  ) {
            return $this->setApiResult( $modelListProduit->getLast() );
        }else{
            return $this->setApiResult(false, true, "erreur pendant l'insertion du produit dans la liste");
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


        if($modelListProduit->delete(" `id_produit`='{$params['id_produit']}' AND  `id_recette`='{$params['id_recette']}' ") ) {

            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression des produits de la liste");
        }
    }



    public function nombreListProduit($params) {

        unset($params['method']);

        $modelListProduit  = new \Application\Models\ListProduit('localhost');

        $res= $modelListProduit->fetchAll(" `id_recette`={$params['id_recette']} ") ;
        //var_dump($res);
        
        
        return $this->setApiResult(count($res));

    }


}