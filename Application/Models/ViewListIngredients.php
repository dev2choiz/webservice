<?php

namespace Application\Models;



class ViewListIngredients extends \Library\Model\Modelview{

	protected $table 	= 'view_liste_ingredients';
	protected $primary 	= 'id_liste';


	public function __construct(){
		parent::__construct();
	}




    /*public function getViewListIngredients($idRecette) {
    	 return $this->fetchAll(" `id_recette`=$idRecette ");

    }*/



}