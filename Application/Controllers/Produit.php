<?php

namespace Application\Controllers;

/**
 *
 *
 */
class Produit extends \Library\Controller\Controller {
    
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
    public function getAllProduits() {

        $modelProduit  = new \Application\Models\Produit('localhost');
        $res=$modelProduit->fetchAll();
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des produit");
        }

    }

    public function getProduit($params) {
        unset($params['method']);



        $modelProduit  = new \Application\Models\Produit('localhost');
        $res=$modelProduit->fetchAll(" `id_produit`='{$params['id_produit']}' ");
        var_dump($res);
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des produit");
        }


    }



    public function insertProduit($params) {

        unset($params['method']);
        //var_dump($params);

        $modelProduit  = new \Application\Models\Produit('localhost');
        
        $res=$modelProduit->insert($params);
            
        if( $res  ) {
            return $this->setApiResult( $modelProduit->getLast() );
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des produit");
        }
    }

     /**
     *  Méthode post($params)
     *
     *  Crée une recette avec les paramètres de la requête POST
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function updateProduit($params) {


        unset($params['method']);

        $params['prix']=$params['prix']+0;
        //var_dump();
        $modelProduit  = new \Application\Models\Produit('localhost');

        if($modelProduit->update(" `id_produit`='{$params['id_produit']}' ", $params) ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la mise a jour");
        }
    }

    /**
     *  Méthode post($params)
     *
     *  Crée une recette avec les paramètres de la requête POST
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function deleteProduit($params) {         //delete une recette


        unset($params['method']);

        $modelProduit  = new \Application\Models\Produit('localhost');


        if($modelProduit->delete(" `id_produit`='{$params['id_produit']}' ") ) {

            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression des produit");
        }
    }




    public function recupererScriptNewProduit($params){

        unset($params['method']);

        $modelProduit  = new \Application\Models\Produit('localhost');
        $modelPopUpProduit  = new \Application\Models\PopUpProduit('localhost');

        $produit=$modelProduit->convEnTab($modelProduit->fetchAll(" `id_produit`={$params['id_produit']} ") );
        $produit=$produit[0];


        if(!empty($produit) ) {
            $script=$modelPopUpProduit->getPopup(   $produit['id_produit'],
                                        $produit['prix'],
                                        $produit['ref'],
                                        $produit['value']);



            $html=" <div class='row' id='WrapperProduit".$produit['id_produit']."'>
        <div class='col-md-8'>
        
            <a hr='".LINK_ROOT."vente/produit/".$produit['id_produit']."'>Produit : <span id='labelValueProduit'>".$produit['value']."</span></a>

        </div>
        <div class='col-md-4'>
            Prix : <span id='labelPrixProduit'>".$produit['prix']."</span> €
            Référence : <span id='labelRefProduit'>".$produit['ref']."</span>
        </div>
        

        <div >
            <button class='btn btn-primary btn-xs col-md-offset-3 popupProduit' id='popupProduit".$produit['id_produit']."' >Modifier ce Produit</button>
            <div class='row'>
                $script
            </div>
            <button class='btn btn-success col-md-3 col-md-offset-3'  >Acheter ce Produit</button>
        </div>
        
    </div>";










            return $this->setApiResult($html);
        }else{
            return $this->setApiResult(false, true, "produit n'existe pas");
        }
    }











}