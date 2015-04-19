<?php

namespace Application\Controllers;

/**
 *
 * QuestionSecrete
 */
class QuestionSecrete extends \Library\Controller\Controller {
    
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
     *  Méthode getquestionsecretes
     *
     *  retourne les questionsecretes
     *       
     *  @return     array
     *
     */
    public function getQuestionSecretes() {




        $modelQuestionSecrete  = new \Application\Models\QuestionSecrete();
        $res=$modelQuestionSecrete->fetchAll();
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des questionsecretes");
        }


    }



   public function getQuestionSecrete($params) {         //ajouter une recette

        unset($params['method']);


        $modelQuestionSecrete  = new \Application\Models\QuestionSecrete();
        $res=$modelQuestionSecrete->fetchAll(" `id_questionsecrete`={$params['id_questionsecrete']} ");
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation de la questionsecrete");
        }


    }




    /**
     * [insertquestionsecrete description]
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    public function insertQuestionSecrete($params) {
        
        unset($params['method']);

        $modelQuestionSecrete  = new \Application\Models\QuestionSecrete();
        
        $res=$modelQuestionSecrete->insert($params);
            
        if(  $res  ) {
            return $this->setApiResult($modelQuestionSecrete->getLast());
        }else{
            return $this->setApiResult(false, true, "erreur pendant l'insertion de la question");
        }


    }




    public function updateQuestionSecrete($params) {
        
        unset($params['method']);

        $modelQuestionSecrete  = new \Application\Models\QuestionSecrete();
        
        $res=$modelQuestionSecrete->update(" `id_questionsecrete`='{$params['id_questionsecrete']}'", $params);
            
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la modification de la question");
        }


    }




    public function deleteQuestionSecrete($params) {
        
        unset($params['method']);

        $modelQuestionSecrete  = new \Application\Models\QuestionSecrete();
        
        $res=$modelQuestionSecrete->delete("`id_questionsecrete`='{$params['id_questionsecrete']}'");
            
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression de la question");
        }


    }


    

}