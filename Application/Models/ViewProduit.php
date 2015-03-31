<?php

namespace Application\Models;



class ViewProduit extends \Library\Model\Modelview{

	protected $table 	= 'view_produit';
	protected $primary 	= 'id_produit';


	public function __construct(){
		parent::__construct();

	}
}




