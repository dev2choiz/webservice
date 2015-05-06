<?php

namespace Application\Controllers;

/**
 *
 *
 */
class Recherche extends \Library\Controller\Controller {
    
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
    public function getAutoCompletion($params) {
        unset($params['method']);
        $mot=$params['recherche'];
        $ou = 'titre';  // $params['ou'];

        /*if(!$this->verifierChaine($chaine) ){
            //caracteres non permis 
            return $this->setApiResult( [] );
        }        
        $ou=$this->echapper($ou);*/

        $modelRecette  = new \Application\Models\Recette();        
        $res=$modelRecette->fetchAllLike($mot, $ou, " ORDER BY $ou LIMIT 0,10 ");
        

        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation de l'auto completion");
        }

    }



   public function getRecherche($params) {
        unset($params['method']);
        //var_dump("params recu",$params);
        $mot = $params['recherche'];
        $ou =  $params['ou'];

        //var_dump($mot, $ou);
        
        /*if(!$this->verifierChaine($mot) ){
            //caracteres non permis 
            return $this->setApiResult( false, true, 'Vous ne pouvez pas faire cette recherche' );
        }
        
        $ou=$this->echapper($ou);*/
        //echo "<br> ou apres echappe=".$ou."<br>";
        $modelViewRecette  = new \Application\Models\ViewRecette();
        $res=$modelViewRecette->fetchAllLike($mot, $ou, " ORDER BY $ou ");
        
        //var_dump("viewrecettes",$res);

        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation de l'auto completion");
        }

    }


   public function verifierChaine($chaine) {
        if ($chaine=="." || $chaine==".." || $chaine=="..." ) {
            return false;
        }
        return true;
    }






}