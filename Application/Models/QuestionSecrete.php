<?php

namespace Application\Models;



class QuestionSecrete extends \Library\Model\Model{

	protected $table 	= 'questionsecrete';
	protected $primary 	= 'id_questionsecrete';


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


}