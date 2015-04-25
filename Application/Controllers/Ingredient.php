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
    }


    /**
    *  Méthode post($params)
    *
    *  Crée une recette avec les paramètres de la requête POST       
    *  @param      array       $params     [données de requête]
    *  @return     array
    *
    */
    public function getIngredients() {




        $modelIngredient  = new \Application\Models\Ingredient();
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
    public function insertIngredients($params) {
        
        unset($params['method']);

        $modelIngredient  = new \Application\Models\Ingredient();
        
        $res=$modelIngredient->insert($params);
            var_dump($res);
        if(  $res  ) {
            return $this->setApiResult($modelIngredient->getLast());
        }else{
            return $this->setApiResult(false, true, "erreur pendant l'insertion de l'ingredient, il existe peut-être déjà en base");
        }


    }



    public function updateIngredient($params) {
        
        unset($params['method']);

        $modelIngredient  = new \Application\Models\Ingredient();

        
        $id=$params['id_ingredient'];

        $res=$modelIngredient->update(" `id_ingredient`={$id} ", $params);
            
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant l'insertion des ingredients");
        }


    }


    public function deleteIngredient($params) {
        
        unset($params['method']);

        $modelIngredient  = new \Application\Models\Ingredient();
        
        $res=$modelIngredient->delete(" `id_ingredient`={$params['id_ingredient']} ");
            
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression de l'ingredient");
        }
    }



}