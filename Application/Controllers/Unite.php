<?php

namespace Application\Controllers;

/**
 *
 *
 */
class Unite extends \Library\Controller\Controller {
    
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
     *  retourne les unités
     *       
     *  @return     array
     *
     */
    public function getunites(){




        $modelUnite  = new \Application\Models\Unite('mysql.hostinger.fr');
        $res=$modelUnite->getUnites();
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des Unites");
        }


    }


   /**
     * [insertunites description]
     * @param  [type] $params [description]
     * @return [int]         [l'id de l'unite ajouté]
     */
    public function insertunites($params) {
        
        unset($params['method']);

        $modelUnite  = new \Application\Models\Unite('mysql.hostinger.fr');
        
        $res=$modelUnite->insert($params);
            
        if(  $res  ) {
            return $this->setApiResult($modelUnite->getLast());
        }else{
            return $this->setApiResult(false, true, "erreur pendant l'insertion des unites");
        }


    }



    public function updateunite($params) {
        
        unset($params['method']);

        $modelUnite  = new \Application\Models\Unite('mysql.hostinger.fr');
        

        $id=$params['id_unite'];

        $res=$modelUnite->update(" `id_unite`={$id} ", $params);
            
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant l'insertion des unites");
        }


    }


    public function deleteunite($params) {
        
        unset($params['method']);

        $modelUnite  = new \Application\Models\Unite('mysql.hostinger.fr');
        
        $res=$modelUnite->delete(" `id_unite`={$params['id_unite']} ");
            
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression de l'unite");
        }
    }


}