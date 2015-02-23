<?php

namespace Application\Controllers;

/**
 *
 *
 */
class ListeIngredients extends \Library\Controller\Controller {
    
    /**
     *  Méthode __construct()
     *
     *  Constructeur par défaut appelant le constructeur de Library\Controller\Controller
     *
     */
    public function __construct() {
        parent::__construct();
    }


    public function insertlisteingredients($params) {

        unset($params['method']);
        $modelListeIngredients  = new \Application\Models\ListeIngredients('localhost');

        //var_dump($params);
        $params['ingredients']=json_decode($params['ingredients']) ;
        $params['unites']=json_decode($params['unites']) ;
        $params['quantites']=json_decode($params['quantites']) ;
        //return $this->setApiResult( $params );
        $res=$modelListeIngredients->InsertListeIngredients($params);
            
        if($res ) {
            return $this->setApiResult( $res );
        }else{
            return $this->setApiResult(false, true, "erreur pendant l'insertion des ingredients");
        }


    }



}