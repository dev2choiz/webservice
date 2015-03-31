<?php

namespace Application\Models;



class Ingredient extends \Library\Model\Model{

	protected $table 	= 'ingredients';
	protected $primary 	= 'id_ingredient';


	public function __construct(){
		parent::__construct();
	}




    


        

    /*public function insertIngredients(){
                
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des ingredients");
        }
    }*/


}