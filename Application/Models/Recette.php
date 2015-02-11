<?php

namespace Application\Models;



class Recette extends \Library\Model\Model{

	protected $table 	= 'recette';
	protected $primary 	= 'id_recette';


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	public function getLast(){
		return $this->getDatabase()->lastInsertId();
	}


}