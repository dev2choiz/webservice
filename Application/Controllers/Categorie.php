<?php

namespace Application\Controllers;

/**
 *
 * Categorie
 */
class Categorie extends \Library\Controller\Controller {
    
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
     *  Méthode getcategories
     *
     *  retourne les categories
     *       
     *  @return     array
     *
     */
    public function getcategories() {         //ajouter une recette




        $modelCategorie  = new \Application\Models\Categorie('localhost');
        $res=$modelCategorie->getCategories();
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des categories");
        }


    }



    /**
     * [insertcategorie description]
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    public function insertcategorie($params) {
        
        unset($params['method']);

        $modelCategorie  = new \Application\Models\Categorie('localhost');
        
        $res=$modelCategorie->insert($params);
            
        if(  $res  ) {
            return $this->setApiResult($modelCategorie->getLast());
        }else{
            return $this->setApiResult(false, true, "erreur pendant l'insertion de la catégorie");
        }


    }




    public function updatecategorie($params) {
        
        unset($params['method']);

        $modelCategorie  = new \Application\Models\Categorie('localhost');
        
        $res=$modelCategorie->update("`id_cat`='{$params['id_cat']}'", $params);
            
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la modification de la catégorie");
        }


    }




    public function deletecategorie($params) {
        
        unset($params['method']);

        $modelCategorie  = new \Application\Models\Categorie('localhost');
        
        $res=$modelCategorie->delete("`id_cat`='{$params['id_cat']}'");
            
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression de la catégorie");
        }


    }

}