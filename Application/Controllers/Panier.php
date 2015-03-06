<?php

namespace Application\Controllers;

/**
 *
 * Panier
 */
class Panier extends \Library\Controller\Controller {
    
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
     *  Méthode getpaniers
     *
     *  retourne les paniers
     *       
     *  @return     array
     *
     */
    public function getpanier() {         //ajouter une recette




        $modelPanier  = new \Application\Models\Panier('localhost');
        $res=$modelPanier->fetchAll();
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des paniers");
        }


    }



    /**
     * [insertpanier description]
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    public function insertpanier($params) {
        
        unset($params['method']);

        $modelPanier  = new \Application\Models\Panier('localhost');
        
        $res=$modelPanier->insert($params);
            
        if(  $res  ) {
            return $this->setApiResult($modelPanier->getLast());
        }else{
            return $this->setApiResult(false, true, "erreur pendant l'insertion de la catégorie");
        }


    }




    public function updatepanier($params) {
        
        unset($params['method']);

        $modelPanier  = new \Application\Models\Panier('localhost');
        
        $res=$modelPanier->update(" `id_panier`='{$params['id_panier']}'", $params);
            
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la modification de la panier");
        }


    }




    public function deletepanier($params) {
        
        unset($params['method']);

        $modelPanier  = new \Application\Models\Panier('localhost');
        
        $res=$modelPanier->delete("`id_cat`='{$params['id_panier']}'");
            
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression de la panier");
        }


    }

}