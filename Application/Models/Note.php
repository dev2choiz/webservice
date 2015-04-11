<?php

namespace Application\Models;



class Note extends \Library\Model\Model{

	protected $table 	= 'note';
	protected $primary 	= 'id_note';


	public function __construct(){
		parent::__construct();
	}



}