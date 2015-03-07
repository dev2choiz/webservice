<?php

namespace Application\Models;



class Categorie extends \Library\Model\Model{

	protected $table 	= 'categorie';
	protected $primary 	= 'id_cat';


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
    public function getCategories() {         //ajouter une recette
    	
    	return $this->fetchAll();

    }




}