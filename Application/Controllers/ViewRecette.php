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
     *  Méthode getviewrecettes($params)
     *
     *  Récupèrera un nombre donnée de recettes
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     * 
     */
    public function getviewrecette($params) {
        unset($params['method']);

        //recupere la recette        
        $modelVR     = new \Application\Models\ViewRecette('localhost');
        $viewR       = $modelVR->convEnTab($modelVR->fetchAll("`id_recette`='{$params['id_recette']}'"));
        $viewR=$viewR[0];
        

        if( empty($viewR) ){
            $this->message->addError("aucune recette !");
        }

        //recupere les ingredients
        $modelVLI     = new \Application\Models\ViewListIngredients('localhost');
        $viewLI       = $modelVLI->convEnTab( $modelVLI->getviewlistingredients($viewR['id_recette'])  );
        $viewLI=$viewLI;
        

        if( empty($viewLI) ){
            $this->message->addError("aucun ingredient !");
        }else{
            //colle les ingredients à la recette
            $viewR['ingredients']=$viewLI;
        }

        return $this->setApiResult($viewR);
    }




public function getallviewrecettes($params) {
        unset($params['method']);
        
        $modelVR     = new \Application\Models\ViewRecette('localhost');
        $viewR       = $modelVR->convEnTab($modelVR->fetchAll());

        //$viewR=$viewR[0];
        var_dump("getviewrecettes",$viewR);
        if( empty($viewR) ){
            $this->message->addError("aucune recette !");
        }

        return $this->setApiResult($viewR);
    }    



}