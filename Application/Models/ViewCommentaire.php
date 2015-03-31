<?php

namespace Application\Models;



class ViewCommentaire extends \Library\Model\Modelview{

	protected $table 	= 'view_commentaire';
	protected $primary 	= 'id_com';


	public function __construct(){
		parent::__construct();
	}

}