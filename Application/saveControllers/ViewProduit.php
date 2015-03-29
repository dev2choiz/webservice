<?php
 
namespace Application\Controllers;

/**
 *
 *
 */
class ViewProduit extends \Library\Controller\Controller {
    
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
     *  Méthode getproduits($params)
     *  Méthode getviewproduits($params)
     *
     *  Récupèrera un nombre donnée de produits
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     * 
     */



    public function getAllViewProduits() {
        
        $modelViewProduit       = new \Application\Models\ViewProduit('localhost');
        $viewAllProduits           = $modelViewProduit->convEnTab($modelViewProduit->fetchAll() );
        if( empty($viewAllProduits[0]) ){
             return $this->setApiResult(false, true, "aucun produit");
        }else{
            return $this->setApiResult($viewAllProduits);
        }            

        
    }




    public function getViewProduit($param) {      //  obtenir une produit par son id
        unset($param['method']);

        $param            = (empty($param["id_produit"]))? null : ($param["id_produit"]+0);

        //recupere le produit
        $modelViewProduit = new \Application\Models\ViewProduit('localhost');
        //$param            = (int) $param;
        $viewProduit      = $modelViewProduit->convEnTab($modelViewProduit->findByPrimary($param));
        
        if(!empty($viewProduit)){
            return $this->setApiResult($viewProduit);
        }else{
            return $this->setApiResult(false, true, "produit non trouvé");
        }

        
    }
}

