<?php

namespace Application\Controllers;

/**
 *
 * Commentaire
 */
class ViewCommentaire extends \Library\Controller\Controller {
    
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
     *  Méthode getcommentaires
     *
     *  retourne les commentaires
     *       
     *  @return     array
     *
     */
    public function getViewCommentaire($params) {

        unset($params['method']);
        $param            = (empty($params["id_com"]))? null : ($params["id_cat"]+0);
        

        $modelCommentaire  = new \Application\Models\ViewCommentaire('localhost');
        $res = $modelCommentaire->findByPrimary($param);
        var_dump($res);
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des commentaires");
        }


    }



}