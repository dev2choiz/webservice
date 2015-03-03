<?php

namespace Application\Controllers;

/**
 *
 *
 */
class Ingredient extends \Library\Controller\Controller {
    
    /**
     *  Méthode __construct()
     *
     *  Constructeur par défaut appelant le constructeur de Library\Controller\Controller
     *
     */
    public function __construct() {
        parent::__construct();
        echo "classe trouve";
        var_dump($_POST);
    }


    /**
    *  Méthode post($params)
    *
    *  Crée une recette avec les paramètres de la requête POST       
    *  @param      array       $params     [données de requête]
    *  @return     array
    *
    */
    public function getingredients() {




        $modelIngredient  = new \Application\Models\Ingredient('localhost');
        $res=$modelIngredient->fetchAll();
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des ingredients");
        }


    }


    /**
     * [insertingredients description]
     * @param  [type] $params [description]
     * @return [int]         [l'id de l'ingredient ajouté]
     */
    public function insertingredients($params) {
        echo "methode insert";
        unset($params['method']);

        $modelIngredient  = new \Application\Models\Ingredient('localhost');
        
        $res=$modelIngredient->insert($params);
            
        if(  $res  ) {
            return $this->setApiResult($modelIngredient->getLast());
        }else{
            return $this->setApiResult(false, true, "erreur pendant l'insertion des ingredients");
        }


    }






}