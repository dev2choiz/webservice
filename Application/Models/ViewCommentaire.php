<?php

namespace Application\Models;



class ViewCommentaire extends \Library\Model\Modelview{

	protected $table 	= 'view_commentaire';
	protected $primary 	= 'id_com';


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}

}