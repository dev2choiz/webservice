<?php

namespace Application\Controllers;

/**
 *
 *
 */
class ViewListIngredients extends \Library\Controller\Controller {
    
    /**
     *  Méthode __construct()
     *
     *  Constructeur par défaut appelant le constructeur de Library\Controller\Controller
     *
     */
    public function __construct() {
        parent::__construct();
    }

    public function getviewlistingredients($params) {

        unset($params['method']);
        $modelVLI  = new \Application\Models\ViewListIngredients('mysql.hostinger.fr');

        
        $idRecette=$params['id_recette']+0;

        
        $res=$modelVLI->fetchAll(" `id_recette`=$idRecette ");
        
        if(!empty($res) ) {
            return $this->setApiResult( $res );
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recup des ingredients");
        }


    }




}