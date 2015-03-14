<?php

namespace Application\Controllers;

/**
 *
 * Categorie
 */
class ViewCategorie extends \Library\Controller\Controller {
    
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
    public function getViewCategorie($params) {         //ajouter une recette

        unset($params['method']);
        $param            = (empty($params["id_cat"]))? null : ($params["id_cat"]+0);
        
        //var_dump($param);

        $modelCategorie  = new \Application\Models\ViewCategorie('localhost');
        $res = $modelCategorie->findByPrimary($param);
        var_dump($res);
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des categories");
        }


    }



}