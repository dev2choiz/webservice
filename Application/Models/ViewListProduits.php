<?php

namespace Application\Models;



class ViewListProduits extends \Library\Model\Modelview{

	protected $table 	= 'view_liste_produits';
	protected $primary 	= 'id_liste_produits';


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}

}