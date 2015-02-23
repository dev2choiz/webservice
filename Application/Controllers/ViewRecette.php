<?php

namespace Application\Controllers;

/**
 *
 *
 */
class ViewRecette extends \Library\Controller\Controller {
    
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
     *  Méthode getrecettes($params)
     *
     *  Récupèrera un nombre donnée de recettes
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     * 
     */
    public function getAllViewRecettes() {      //  obtenir toutes les recettes
        
        
        $modelViewAllRecette       = new \Application\Models\ViewRecette('localhost');
        $viewAllRecettes           = $modelViewAllRecette->fetchAll();
        if( empty($viewAllRecettes[0]) ){
            return $this->setApiResult(false, true, "Aucune Recette");
        }

        return $this->setApiResult($viewAllRecettes);
    }

    public function getViewRecette($param) {      //  obtenir une recette par son id
        
        $param            = (empty($param["id_recette"]))? null : $param["id_recette"];

        $modelViewRecette = new \Application\Models\ViewRecette('localhost');
        $param            = (int) $param;
        $viewRecettes     = $modelViewRecette->findByPrimary($param);
        if( empty($viewRecettes[0]) ){
            return $this->setApiResult(false, true, "Aucune recette de cet id");
        }

        return $this->setApiResult($viewRecettes);
    }



}