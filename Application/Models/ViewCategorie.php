<?php

namespace Application\Models;



class ViewCategorie extends \Library\Model\Modelview{

	protected $table 	= 'view_categorie';
	protected $primary 	= 'id_cat';


	public function __construct(){
		parent::__construct();
	}

}