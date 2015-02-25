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
        $viewAllRecettesI          = $viewAllRecettes;
        //var_dump($viewAllRecetteI);
        if( empty($viewAllRecettes[0]) ){
             $this->message->addError("Aucune Recette");
        }else{



            //recupere les ingredients
            $modelVLI     = new \Application\Models\ViewListIngredients('localhost');

            foreach ($viewAllRecettes as $key => $viewRecette) {

                $viewLI       = $modelVLI->convEnTab( $modelVLI->getViewListIngredients( $viewAllRecettes['id_recette'] )  );
                $viewAllRecettes[$key]['ingredients']=$viewLI;

            }   

        }


        return $this->setApiResult($viewAllRecettes);
    }




    public function getViewRecette($param) {      //  obtenir une recette par son id
        unset($param['method']);
        $param            = (empty($param["id_recette"]))? null : ($param["id_recette"]+0);

        //recupere la recette
        $modelViewRecette = new \Application\Models\ViewRecette('localhost');
        //$param            = (int) $param;
        $viewRecette     = $modelViewRecette->findByPrimary($param);
        $viewRecetteI    = $viewRecette[0];
        if( empty($viewRecette[0]) ){
            return $this->setApiResult(false, true, "Aucune recette pour cet id !");
        }

        //recupere les ingredients
        $modelVLI     = new \Application\Models\ViewListIngredients('localhost');
        $viewLI       = $modelVLI->convEnTab( $modelVLI->getviewlistingredients($viewRecetteI->id_recette)  );
        //$viewLI = $viewLI;
        

        if( empty($viewLI) ){
            return $this->setApiResult($viewRecette);
        }else{
            //colle les ingredients à la recette
            $viewRecetteI->ingredients = $viewLI;
        }

        //return $this->setApiResult($viewRecetteI);

        return $this->setApiResult($viewRecette);
    }
}

