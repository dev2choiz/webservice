<?php

namespace Application\Models;



class Ingredient extends \Library\Model\Model{

	protected $table 	= 'ingredients';
	protected $primary 	= 'id_ingredient';


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}




    /**
     *  Méthode post($params)
     *
     *  Crée une recette avec les paramètres de la requête POST       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function getIngredients() {         //ajouter une recette
    	return $this->fetchAll();

    }

        
    public function insertListeIngredients($params){
        //$modelListeIngredient  = new \Application\Models\ListeIngredient('localhost');
        //var_dump($params);
        


        $idIngreds=$params['ingredients'];
        $idRe7=$params['id_ingredient'];
        foreach ($IdIngreds as  $idIngreg) {
            $data= array(
                "id_recette"=>'',
                "id_ingredient"=>'',
                "id_unite"=>'',
                "value"=>''
                );

            $this->insert($data);
        }

        


        if( !empty( $res ) ) {
            return $this->setApiResult( true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des ingredients");
        }
    }

}