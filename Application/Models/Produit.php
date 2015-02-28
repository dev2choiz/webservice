<?php

namespace Application\Models;



class Produit extends \Library\Model\Model{

	protected $table 	= 'produit';
	protected $primary 	= 'id_produit';


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}

}