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
            return $this->setApiResult(null);
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
            return $this->setApiResult(false, true, "erreur pendant l'insertion dans le panier");
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
        $res=$modelPanier->delete(" `id_produit`='{$params['id_produit']}' AND `id_user`='{$params['id_user']}' ");
        var_dump($res);
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression dans le panier");
        }


    }




    public function viderPanier($params) {
        
        unset($params['method']);

        $modelPanier  = new \Application\Models\Panier('localhost');
        
        $res=$modelPanier->delete("`id_user`='{$params['id_user']}'");
            
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression du panier");
        }


    }





    public function getHtmlIconPanier($params) {


        unset($params['method']);

        $modelPanier  = new \Application\Models\Panier('localhost');
        $res=$modelPanier->fetchAll(" `id_user`='{$params['id_user']}'");
        
        if( !empty( $res ) ) {
            $nbrProd=count($res);
            $html="
                $nbrProd
            ";

            return $this->setApiResult( $html);
        }else{
            return $this->setApiResult("0", true, "aucun produit dans le panier");
        }


    }


/**
     * [insertpanier description]
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    public function existeDansPanier($params) {
        
        unset($params['method']);

        $modelPanier  = new \Application\Models\Panier('localhost');
        
        $res=$modelPanier->fetchAll(" `id_user`='{$params['id_user']}' AND  `id_produit`='{$params['id_produit']}'  ");

        if(empty($res) ){
                
            return $this->setApiResult(false);

        }else {
            return $this->setApiResult(true);
        }
    }






}