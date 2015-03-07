<?php

namespace Application\Models;



class Panier extends \Library\Model\Model{

	protected $table 	= 'panier';
	protected $primary 	= 'id_panier';


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}

}