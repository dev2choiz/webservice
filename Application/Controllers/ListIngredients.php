<?php

namespace Application\Controllers;

/**
 *
 *
 */
class ListIngredients extends \Library\Controller\Controller {
    
    /**
     *  Méthode __construct()
     *
     *  Constructeur par défaut appelant le constructeur de Library\Controller\Controller
     *
     */
    public function __construct() {
        parent::__construct();
    }


    public function insertListIngredients($params) {

        unset($params['method']);
        $modelLI  = new \Application\Models\ListIngredients();

        if (empty($params['ingredients']) || empty($params['unites'])  || empty($params['quantites']) ) {
            return $this->setApiResult(false, true, "les données concernant les ingrédients n'ont pas étées recu");
        }

        $params['ingredients']=json_decode($params['ingredients']) ;
        $params['unites']=json_decode($params['unites']) ;
        $params['quantites']=json_decode($params['quantites']) ;
        
        $res=$modelLI->insertListIngredients($params);


            
        if($res ) {
            return $this->setApiResult( $res );
        }else{
            return $this->setApiResult(false, true, "erreur pendant l'insertion des ingredients");
        }


    }



    public function updateListIngredients($params) {

        unset($params['method']);
        $modelLI  = new \Application\Models\ListIngredients();

        var_dump($params);

        if (empty($params['ingredients']) || empty($params['unites'])  || empty($params['quantites']) ) {
            return $this->setApiResult(false, true, "les données concernant les ingrédients n'ont pas étées recu");
        }

        //supression de tout les ingredients de la recette
        $modelLI->delete(" `id_recette`={$params['id_recette']} ");
         


        
        $params['ingredients']=json_decode($params['ingredients']) ;
        $params['unites']=json_decode($params['unites']) ;
        $params['quantites']=json_decode($params['quantites']) ;
        
        $res=$modelLI->insertlistingredients($params);
            
        if($res ) {
            return $this->setApiResult( $res );
        }else{
            return $this->setApiResult(false, true, "erreur pendant la modification des ingredients");
        }


    }





}