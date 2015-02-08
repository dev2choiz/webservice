<?php

namespace Library\Model;

/**
 *
 *
 */
abstract class Modelview extends Model {
    
    /**
     *  Méthode __construct($connexionName)
     *
     *  Constructeur par défaut appelant le constructeur de Library\Model\Model
     *
     *  @param      string      $connexionName      []
     *  @return     void
     */
    public function __construct($connexionName){
        parent::__construct($connexionName);
    }

    /**
     *  Méthode delete($where)
     *
     *  Supprime un élément de la vue
     *
     *  @param      boolean     $where          [Condition]
     *  @return
     */
    public function delete($where) {
        throw new \Exception("Error DELETE impossible sur une view");
    }

    /**
     *  Méthode deleteByPrimary($where)
     *
     *  Supprime un élément de la vue en fonction de sa clé primaire
     *
     *  @param      int|string  $value_primary  [Valeur de la clé primaire]
     *  @return
     */
    public function deleteByPrimary($primary){
        throw new \Exception("Error DELETE BY PRIMARY impossible sur une view");
    }

    /**
     *  Méthode
     *
     *  Ajoute un élément à la vue
     *
     *  @param      array       $data           [Données représentant un élément]
     *  @return
     */
    public function insert($data){
        throw new \Exception("Error INSERT impossible sur une view");
    }
}