<?php

namespace Application\Controllers;

/**
 *
 * Categorie
 */
class Categorie extends \Library\Controller\Controller {
    
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
    public function getcategories() {         //ajouter une recette




        $modelCategorie  = new \Application\Models\Categorie('localhost');
        $res=$modelCategorie->getCategories();
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des categories");
        }


    }




}