<?php

namespace Application\Models;



class Unite extends \Library\Model\Model{

	protected $table 	= 'unite';
	protected $primary 	= 'id_unite';


	public function __construct(){
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
    public function getUnites() { 
    	
    	return $this->fetchAll();

    }




}