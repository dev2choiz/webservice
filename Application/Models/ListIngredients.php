<?php

namespace Application\Models;



class ListIngredients extends \Library\Model\Model{

	protected $table 	= 'liste_ingredients';
	protected $primary 	= 'id_liste';


	public function __construct(){
		parent::__construct();
	}




    public function insertListIngredients($params){



        $idIngreds=$params['ingredients'];
        $idRe7=$params['id_recette'];
        $unites=$params['unites'];
        $quantites=$params['quantites'];
        $i=0;
        $alors=true;
        foreach ($idIngreds as  $idIngred) {
            $data= array(
                "id_recette"=>$idRe7,
                "id_ingredient"=>$idIngred,
                "id_unite"=>$unites[$i],
                "value"=> $quantites[$i]
                );

            $alors=( $alors  && $this->insert($data) );
            $i++;

        }

        return $alors;
        

    }

}