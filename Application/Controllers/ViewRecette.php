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
    public function getViewRecettes() {      //  obtenir toutes les recettes
        
        
        $modelViewRecette       = new \Application\Models\ViewRecette('localhost');
        $viewRecettes           = $modelViewRecette->fetchAll();
        if( empty($viewRecettes[0]) ){
            $this->message->addError("aucune recette !");
        }

        return $this->setApiResult($viewRecettes);
    }



}