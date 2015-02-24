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
     *  Méthode getviewrecettes($params)
     *
     *  Récupèrera un nombre donnée de recettes
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     * 
     */



    /* Naïla */
    public function getAllViewRecettes() {      //  obtenir toutes les recettes
        
        
        $modelViewAllRecette       = new \Application\Models\ViewRecette('localhost');
        $viewAllRecettes           = $modelViewAllRecette->fetchAll();
        if( empty($viewAllRecettes[0]) ){
            return $this->setApiResult(false, true, "Aucune Recette");
        }

        return $this->setApiResult($viewAllRecettes);
    }

    public function getViewRecette($param) {      //  obtenir une recette par son id
        unset($params['method']);
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




    /* Samyn 
    public function getviewrecette($params) {
        unset($params['method']);
        
        $modelVR     = new \Application\Models\ViewRecette('localhost');
        $viewR       = $modelVR->convEnTab($modelVR->fetchAll("`id_recette`='{$params['id_recette']}'"));
        $viewR=$viewR[0];
        //var_dump("getviewrecette",$viewR);
        if( empty($viewR) ){

    public function getviewrecette($params) {
        unset($params['method']);

        //recupere la recette
        $modelVR     = new \Application\Models\ViewRecette('localhost');
        //$viewR       = $modelVR->convEnTab($modelVR->fetchAll("`id_recette`='{$params['id_recette']}'"));
        $viewR       = $modelVR->convEnTab( $modelVR->findByPrimary($params['id_recette']+0 ) );
        
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
        $viewRs       = $modelVR->convEnTab($modelVR->fetchAll());

        //$viewRs=$viewRs[0];
        var_dump("getviewrecettes",$viewRs);
        if( empty($viewRs) ){

            $this->message->addError("aucune recette !");
        }else{



            //recupere les ingredients
            $modelVLI     = new \Application\Models\ViewListIngredients('localhost');

            foreach ($viewRs as $key => $viewR) {

                $viewLI       = $modelVLI->convEnTab( $modelVLI->getViewListIngredients( $viewR['id_recette'] )  );
                $viewRs[$key]['ingredients']=$viewLI;

            }   

        }


        return $this->setApiResult($viewR);
    }

    public function getallviewrecettes($params) {
            unset($params['method']);
            
            $modelVR     = new \Application\Models\ViewRecette('localhost');
            $viewR       = $modelVR->convEnTab($modelVR->fetchAll());

        return $this->setApiResult($viewRs);
    }    


            //$viewR=$viewR[0];
            //var_dump("getviewrecettes",$viewR);
            if( empty($viewR) ){
                $this->message->addError("aucune recette !");
            }

            return $this->setApiResult($viewR);
        }    

    }*/
