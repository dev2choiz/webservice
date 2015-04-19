<?php

namespace Application\Controllers;

/**
 *
 *
 */
class Commentaire extends \Library\Controller\Controller {
    
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
     *  Méthode getcommentaires($params)
     *
     *  Récupèrera tout les commentaires associés a une recette
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     * 
     */
    public function getCommentaires($params) {      //  obtenir tout les commentaires
        
        
        $modelCommentaire   = new \Application\Models\Commentaire();
        $commentaires       = $modelCommentaire->convEnTab( $modelCommentaire->fetchAll(" `id_recette`='{$params['id_recette']}' " ) );

        if( empty($commentaires) ){
            return $this->setApiResult(false, true, "Erreur ou aucun commentaire pour cette recette");
        }

        return $this->setApiResult($commentaires);
    }


    /**
     * [getCommentaire obtenir un commentaire]
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    public function getCommentaire($params) {
        
        
        $modelCommentaire   = new \Application\Models\Commentaire();
        $commentaire       = $modelCommentaire->convEnTab( $modelCommentaire->fetchAll(" `id_com`='{$params['id_com']}' " ) );

        if( empty($commentaire) ){
            return $this->setApiResult(false, true, "Erreur ou aucun commentaire pour cette recette");
        }

        return $this->setApiResult($commentaire);
    }










    /**
     *  Méthode post($params)
     *
     *  Crée un commentaire avec les paramètres de la requête POST
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function insertCommentaire($params) {         //ajouter un commentaire


        unset($params['method']);

        $modelCommentaire  = new \Application\Models\Commentaire();
        $res=$modelCommentaire->insert($params);
        //var_dump($res);
        if($res ) {
            return $this->setApiResult($modelCommentaire->getLast());   //retourne l'id du comm
        }else{
            return $this->setApiResult(0, true, "erreur pendant l'ajout");
        }


    }
    
    /**
     *  Méthode post($params)
     *
     *  Crée un commentaire avec les paramètres de la requête POST
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function updateCommentaire($params) {         //ajouter un commentaire


        unset($params['method']);

        
        $modelCommentaire  = new \Application\Models\Commentaire();

        if($modelCommentaire->update(" `id_com`='{$params['id_com']}' ", $params) ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la mise a jour");
        }


    }
    


    /**
     *  Méthode post($params)
     *
     *  Crée une commentaire avec les paramètres de la requête POST
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function deleteCommentaire($params) {         //delete une commentaire


        unset($params['method']);

        $modelComm  = new \Application\Models\Commentaire();


        if($modelComm->delete(" `id_com`='{$params['id_com']}' ") ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression du commentaire");
        }


    }
    




}