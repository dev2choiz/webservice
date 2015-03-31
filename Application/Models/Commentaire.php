<?php

namespace Application\Models;



class Commentaire extends \Library\Model\Model{

	protected $table 	= 'commentaire';
	protected $primary 	= 'id_com';


	public function __construct(){
		parent::__construct();
	}



}