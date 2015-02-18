<?php

namespace Application\Models;



class ViewRecette extends \Library\Model\Modelview{

	protected $table 	= 'view_recette';


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


}