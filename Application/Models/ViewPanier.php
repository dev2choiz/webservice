<?php

namespace Application\Models;



class ViewPanier extends \Library\Model\Modelview{

	protected $table 	= 'view_panier';
	protected $primary 	= 'id_user';


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}

}