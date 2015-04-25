<?php

namespace Application\Controllers;

/**
 *
 *
 */
class Recette extends \Library\Controller\Controller {
    
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
     * Permet d'obtenir toutes les recettes
     * @return stdClass object 
     */
    public function getRecettes() {
        
        
        $modelRecette   = new \Application\Models\Recette();
        $recettes       = $modelRecette->fetchAll();
        if( empty($recettes[0]) ){
            $this->setApiResult(false, true, "aucune recette !");
        }
        return $this->setApiResult($recettes);
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
    public function insertRecette($params) {         //ajouter une recette


        unset($params['method']);
        $modelRecette  = new \Application\Models\Recette();

        if($modelRecette->insert($params) ) {
            return $this->setApiResult($modelRecette->getLast());
        }else{
            return $this->setApiResult(0, true, "erreur pendant l'ajout");
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
    public function updateRecette($params) {         //ajouter une recette


        unset($params['method']);

        //var_dump();
        $modelRecette  = new \Application\Models\Recette();

        if($modelRecette->update(" `id_recette`='{$params['id_recette']}' ", $params) ) {
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
    public function deleteRecette($params) {         //delete une recette


        unset($params['method']);

        $modelLI  = new \Application\Models\ListIngredients();
        $modelLP  = new \Application\Models\ListProduit();


        if($modelLI->delete(" `id_recette`='{$params['id_recette']}' ") ) {


            if($modelLP->delete(" `id_recette`='{$params['id_recette']}' ") ) {
                //si la suppression des ingredients et des produits c'est bien passée on tente de sup la recette
                $modelRecette  = new \Application\Models\Recette();
                if($modelRecette->delete(" `id_recette`='{$params['id_recette']}' ") ){
                    return $this->setApiResult(true);
                }else{
                    return $this->setApiResult(false, true, "erreur pendant la suppression de la recette");
                }
                return $this->setApiResult(true);
            }else{
                return $this->setApiResult(false, true, "erreur pendant la suppression des produits");
            }
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression des ingredients");
        }


    }
    



    public function getImageRecette($params) {

        unset($params['method']);

        $modelRecette  = new \Application\Models\Recette();
        echo "`id_recettre`='{$params['id_recette']}'";
        $res=$modelRecette->convEnTab($modelRecette->fetchAll("`id_recette`={$params['id_recette']}"));
            
        if(  !empty($res)  ) {
            return $this->setApiResult($res[0]['img']);
        }else{
            return $this->setApiResult(false, true, "recette non trouvée");
        }


    }




}