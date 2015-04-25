<?php

namespace Library\Controller;

/**
 *
 *
 */
abstract class Controller {
    
    /**
     * Résultat renvoyé par l'API
     * @var object \stdClass
     */
    private $apiResult;



    /**
     *  Méthode __construct()
     *
     *  Constructeur par défaut qui initialise le controller
     *
     *  @param
     *  @return     void
     *
     */
    public function __construct() {

        /* 
        stdClass est une des classes prédéfinies de PHP5
        Elle permet de définir des méthodes ou des attributs à une variable instanciée en objet (mot-clé new)
        */
        $this->apiResult                     = new \stdClass();   
        $this->apiResult->response           = "";
        $this->apiResult->apiError           = false;
        $this->apiResult->apiErrorMessage    = "";
        $this->apiResult->page               = "";
        $this->apiResult->sendMode           = 'json';

    }

    /**
     *  Méthode setApiResult($response, $apiError = false, $apiErrorMessage="")
     *
     *  setter de la variable privée $apiResult de type \stdClass (initialisée dans le constructeur)
     *
     *  @param      any                 $response           [Résultat de la requête]
     *  @param      boolean             $apiError           [Erreur au sein de l'API ou non]
     *  @param      string              $apiErrorMessage    [Message d'erreur renvoyé par l'API]
     *  @return     object \stdClass
     *
     */
    protected function setApiResult($response, $apiError = false, $apiErrorMessage="") {
        $this->apiResult->response           = $response;
        $this->apiResult->apiError           = $apiError;
        $this->apiResult->apiErrorMessage    = $apiErrorMessage;
        $this->apiResult->sendMode           = $this->getMode();
        return $this->apiResult;
    }


    protected function setMode($mode) {
        $this->apiResult->sendMode= $mode;
    }

    protected function getMode() {
        return $this->apiResult->sendMode;
    }


    public function convEnTab($tab){
        $modelCategorie  = new \Application\Models\Categorie();
        return $modelCategorie->convEnTab($tab);
    }

    public function retirerCaractereSpeciaux($chaine){
        $modelCategorie  = new \Application\Models\Categorie();
        return $modelCategorie->retirerCaractereSpeciaux($chaine);
    }


    public function echapper($chaine){
        $modelCategorie  = new \Application\Models\Categorie();
        return $modelCategorie->echapper($chaine);
    }

}