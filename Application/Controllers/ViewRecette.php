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
        
        var_dump("getAllViewRecettes");
        $modelViewAllRecette       = new \Application\Models\ViewRecette('localhost');
        $viewAllRecettes           = $modelViewAllRecette->convEnTab($modelViewAllRecette->fetchAll() );
        if( empty($viewAllRecettes[0]) ){
             $this->message->addError("Aucune Recette");
        }else{

            //var_dump($viewAllRecettes);

            //recupere les ingredients
            $modelVLI     = new \Application\Models\ViewListIngredients('localhost');

            foreach ($viewAllRecettes as $key => $viewRecette) {

                $viewLI       = $modelVLI->convEnTab( $modelVLI->fetchAll(" `id_recette`={$viewRecette['id_recette']}"));
                $viewAllRecettes[$key]['ingredients']=$viewLI;
            }

            //recupere les produits
            $modelVLP     = new \Application\Models\ViewListProduits('localhost');

            foreach ($viewAllRecettes as $key => $viewRecette) {

                $viewLP       = $modelVLP->convEnTab( $modelVLP->fetchAll(" `id_recette`={$viewRecette['id_recette']}")) ;
                $viewAllRecettes[$key]['produits']=$viewLP;
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
        $viewRecette      = $modelViewRecette->convEnTab($modelViewRecette->findByPrimary($param));
        $viewRecetteIP    = $viewRecette[0];
        if( empty($viewRecette[0]) ){
            return $this->setApiResult(false, true, "Aucune recette pour cet id !");
        }

        //recupere les ingredients
        $modelVLI     = new \Application\Models\ViewListIngredients('localhost');
        $viewLI       = $modelVLI->convEnTab( $modelVLI->fetchAll(" `id_recette`={$viewRecetteIP['id_recette']}"));
        var_dump($viewLI);

        if( empty($viewLI) ){
            return $this->setApiResult($viewRecetteIP);
        }else{
            //colle les ingredients à la recette
            $viewRecetteIP['ingredients'] = $viewLI;
        }

        //recupere les produits
        $modelVLP     = new \Application\Models\ViewListProduits('localhost');
        $viewLP       = $modelVLI->convEnTab( $modelVLP->fetchAll(" `id_recette`={$viewRecetteIP['id_recette']}"));
        //$viewLI = $viewLI;
        

        if( empty($viewLP) ){
            return $this->setApiResult($viewRecetteIP);
        }else{
            //colle les produits à la recette
            $viewRecetteIP['produits'] = $viewLP;
        }



        //return $this->setApiResult($viewRecetteI);

        return $this->setApiResult($viewRecetteIP);
    }
}

