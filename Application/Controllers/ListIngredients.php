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


    public function insertlistingredients($params) {

        unset($params['method']);
        $modelLI  = new \Application\Models\ListIngredients('localhost');

        //var_dump($params);
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



    public function updatelistingredients($params) {

        unset($params['method']);
        $modelLI  = new \Application\Models\ListIngredients('localhost');


        //supression de tout les ingredients de la recette
        $modelLI->delete(" `id_recette`={$params['id_recette']} ");
         



        //var_dump($params);
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