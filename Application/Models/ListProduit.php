<?php

namespace Application\Models;



class ListProduit extends \Library\Model\Model{

	protected $table 	= 'liste_produits';
	protected $primary 	= 'id_liste_produits';


	public function __construct(){
		parent::__construct();
	}

}