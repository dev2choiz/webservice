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
     *  retourne les paniers // ça sert à rien ça, c'ets la vue qui va le faire
     *       
     *  @return     array
     *
     */
    public function getPanier($params) {         //ajouter une recette


        unset($params['method']);

        $modelPanier  = new \Application\Models\Panier('localhost');
        $res=$modelPanier->fetchAll(" `id_user`='{$params['id_user']}'");
            
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
    public function insertPanier($params) {
        
        unset($params['method']);

        $modelPanier  = new \Application\Models\Panier('localhost');
        
        $res=$modelPanier->insert($params);
            
        if(  $res  ) {
            return $this->setApiResult($modelPanier->getLast());
        }else{
            return $this->setApiResult(false, true, "erreur pendant l'insertion de la catégorie");
        }


    }




    public function updatePanier($params) {
        
        unset($params['method']);

        $modelPanier  = new \Application\Models\Panier('localhost');
        
        $res=$modelPanier->update(" `id_panier`='{$params['id_panier']}'", $params);
            
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la modification de la panier");
        }


    }




    public function deletePanier($params) {
        
        unset($params['method']);

        $modelPanier  = new \Application\Models\Panier('localhost');
        
        $res=$modelPanier->delete("`id_panier`='{$params['id_panier']}'");
            
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression de la panier");
        }


    }

}