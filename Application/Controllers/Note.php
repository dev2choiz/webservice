<?php

namespace Application\Controllers;

/**
 *
 *
 */
class Note extends \Library\Controller\Controller {
    
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
    *  Méthode post($params)
    *
    *  Crée une recette avec les paramètres de la requête POST       
    *  @param      array       $params     [données de requête]
    *  @return     array
    *
    */
    public function updateNote($params) {
        unset($params['method']);

        $modelNote  = new \Application\Models\Note();
        $res=$modelNote->fetchAll(" `id_user`={$params['id_user']} AND  `id_recette`={$params['id_recette']}  ");
        
        //si la note pour la recette n'existe pas
        if (empty($res) ) {
            $res=$modelNote->insert($params);
            $res=($res>0)?true:false;
        } else {
            $res=$modelNote->update(" `id_user`='{$params['id_user']}' AND  `id_recette`='{$params['id_recette']}'  ", $params);
        }
        
        
        
        if( $res  ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la maj de la note");
        }

    }

    public function getNote($params) {
        unset($params['method']);



        $modelNote  = new \Application\Models\Note();
        $res=$modelNote->convEnTab($modelNote->fetchAll(" `id_user`='{$params['id_user']}' AND  `id_recette`='{$params['id_recette']}'  ") );
        var_dump($res);
        
        if( !empty( $res ) ) {
            return $this->setApiResult( $res[0]['value']);
        }else{
            return $this->setApiResult(0, true, "erreur pendant la recuperation de la note");
        }


    }




    public function getMoyenneNote($params) {
        unset($params['method']);



        $modelNote  = new \Application\Models\Note();
        $notes=$modelNote->convEnTab($modelNote->fetchAll(" `id_recette`='{$params['id_recette']}'  ") );
        $somme=0;
        foreach ($notes as $note) {
            $somme+=$note['value'];
        }

        $moyenne=0;
        if(count($notes)>0){
            $moyenne=$somme/count($notes);
        }
        
        return $this->setApiResult( $moyenne);
        


    }



}