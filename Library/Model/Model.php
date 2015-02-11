<?php

namespace Library\Model;

/**
 *
 *
 */
abstract class Model {

    /**
     * La base de données utilisée
     * @var class Library\Model\Connexion
     */
    private $database;
    /**
     * Nom de la table correspondant au modèle
     * @var string
     */
    protected $table;
    /**
     * Nom de la clé primaire de la table correspondant au modèle
     * @var string
     */
    protected $primary;
    /**
     * Ensemble des paramètres nécessaires pour valider les opérations GET, POST, PUT ou DELETE
     * @var array
     */
    protected $scheme = array();
    
    /**
     *  Méthode __construct($connexionName)
     *
     *  Initialise le modèle pour la connexion transmise en paramètre
     * 
     *  @param      string      $connexionName      [Nom de la connexion à utiliser]
     *  @return     void
     *
     */
    public function __construct($connexionName){
        $classConnexion = \Library\Model\Connexion::getInstance();
        $this->database = $classConnexion::getConnexion($connexionName);
    }

    /**
     *  Méthode setScheme($scheme)
     *
     *  Définit la variable $scheme
     *
     *  @param      array       $scheme             [modèle des données]
     *  @return     void
     *
     */
    public function setScheme($scheme) {
        $this->scheme = $scheme;
    }


    /**
     * 
     */
    public function getDatabase(){
        return $this->database;
    }


    /**
     *  Méthode getScheme()
     *
     *  Retourne la valeur de la variable $scheme
     *
     *  @param
     *  @return     array
     *
     */
    public function getScheme() {
        return $this->scheme;
    }

    /**
     *  Méthode setPrimary($primary)
     *
     *  Définit la variable $primary
     *
     *  @param      string      $primary            [Nom de la clé primaire]
     *  @return     void
     *
     */
    public function setPrimary($primary) {
        $this->primary = $primary;
    }
    /**
     *  Méthode getPrimary()
     *
     *  Retourne la valeur de la variable $primary
     *
     *  @param
     *  @return     string
     *
     */
    public function getPrimary() {
        return $this->primary;
    }
    
    /**
     *  Méthode findByPrimary($value_primary, $fields="*")
     *
     *  Récupère un élément en fonction de la clé primaire
     *  Si le deuxième paramètre n'est pas renseigné, la méthode renvoie tous les champs de la table
     * 
     *  @param      string|int  $value_primary      [Valeur de la clé primaire à selectionner]
     *  @param      string      $fields             [Liste des champs à selectionner]
     *  @return     array
     *
     */
    public function findByPrimary($value_primary, $fields="*") {
        $sql = $this->database->prepare("SELECT $fields FROM `{$this->table}` WHERE `{$this->primary}`=:primary");
        $sql->execute(array("primary"=>$value_primary));
        return $sql->fetchAll();
    }

    /**
     *  Méthode fetchAll($where=1, $fields="*")
     *
     *  Récupère un ou plusieurs éléments en fonction d'une condition
     *  Si aucun paramètres n'a été renseigné, la méthode renvoie tous les éléments trouvés
     * 
     *  @param      string|int  $where              [Condition pour effectuer la selection (au format SQL)]
     *  @param      string      $fields             [Liste des champs à selectionner]
     *  @return     array
     *
     */
    public function fetchAll($where=1, $fields="*") {
        $sql = $this->database->prepare("SELECT $fields FROM `{$this->table}` WHERE $where");
        $sql->execute();
        return $sql->fetchAll();
    }
    
    /**
     *  Méthode fetchLasObject()
     *
     *  Récupère le dernier élément ajouté en base à partir de son identifiant
     *
     *  @param      void
     *  @return     array
     *
     */
    public function fetchLastObject() {
        $id = $this->database->lastInsertId();
        return $this->findByPrimary($id);
    }

    /**
     *  Méthode insert($data)
     *
     *  Effectue une insertion d'un élément en base
     *
     *  @param      array       $data               [Données]
     *  @return     boolean
     *
     */
    public function insert($data) {

        //$data = $this->checkScheme($data);
        
        if(!is_array($data)){
            return false;   //$data
        }

        $listFields = '`'.implode('`,`', array_keys($data)).'`';
        $listValues = ':'.implode(',:', array_keys($data));
        
        $sql = $this->database->prepare("INSERT INTO `{$this->table}` ($listFields) VALUES ($listValues)");
        unset($listFields, $listValues);
        return $sql->execute($data);        //bool
    }

    /**
     *  Méthode insertWithReturn($data)
     *
     *  Effectue une insertion d'un élément en base
     *
     *  @param      array       $data               [Données]
     *  @return     array
     *
     */
    public function insertWithReturn($data) {
        $data = $this->checkScheme($data);
        if(!is_array($data)){
            return $data;
        }
        $listFields = '`'.implode('`,`', array_keys($data)).'`';
        $listValues = ':'.implode(',:', array_keys($data));
        $sql = $this->database->prepare("INSERT INTO `{$this->table}` ($listFields) VALUES ($listValues)");
        $sql->execute($data);
        unset($listFields, $listValues, $data);
        return $this->fetchLastObject();
    }

    /**
     *  Méthode updateByPrimary($data, $strict=true)
     *
     *  Effectue une mise à jour d'un élément en fonction de sa clé primaire
     *
     *  @param      array       $data               [Données]
     *  @param      boolean     $strict             [Retour strict ou non permet la prise en compte des requêtes n'affectant aucun élément] 
     *  @return     array|boolean
     *
     */
    public function updateByPrimary($data, $strict=true) {
        $data = $this->checkScheme($data);
        if(!is_array($data)) {
            return $data;
        }        
        $primary_value = $data[$this->getPrimary()];
        $params = array();
        foreach($data as $key => $value) {
            if($key!==$this->getPrimary()) { $params[$key] = $value; }
        }
        $listFieldsValue = $this->updateListFieldsValues($data, $this->primary);
        //var_dump($data,$params, $listFieldsValue);
        $sql = $this->database->prepare("UPDATE `{$this->table}` SET $listFieldsValue WHERE `{$this->primary}`=$primary_value");
        unset($listFieldsValue);
        $sql->execute($params);
        return $this->returnAffectedRowBoolean($sql, $strict);
    }

    /**
     *  Méthode updateByPrimary($data, $strict=true)
     *
     *  Effectue une mise à jour d'un élément en fonction d'une condition
     *
     *  @param      boolean     $where              [Condition pour effectuer la mise a jour (au format SQL)]
     *  @param      array       $data               [Données représentant l'élément]
     *  @param      boolean     $strict             [Retour strict ou non permet la prise en compte des requêtes n'affectant aucun élément] 
     *  @return     array|boolean
     *
     */
    public function update($where, $data, $strict=true) {
        $data = $this->checkScheme($data);
        if(!is_array($data)){
            return $data;
        }
        $listFieldsValue = $this->updateListFieldsValues($data);
        $sql = $this->database->prepare("UPDATE `{$this->table}` SET $listFieldsValue WHERE $where");
        unset($listFieldsValue);
        $sql->execute($data);
        return $this->returnAffectedRowBoolean($sql, $strict);
    }

    /**
     *  Méthode updateListFieldsValues($data, $exclude=null)
     *
     *  Formate les données de $data sous forme d'une chaîne de caractères (liste de clé=valeur)
     *
     *  @param      array       $data               [Données]
     *  @param      string      $exclude            [Nom de la clé à ommettre]
     *  @return     string
     *
     */
    protected function updateListFieldsValues($data, $exclude=null) {
        $list = "";
        foreach($data as $key=>$value){
            if($exclude==$key){
                continue;
            }
            $list .= "`$key`=:$key,";
        }
        return substr($list, 0, -1);
    }
    
    /**
     *  Méthode deleteByPrimary($value_primary)
     *
     *  Supprime un élément de la base en fonction de la clé primaire
     * 
     *  @param      string|int  $value_primary      [Valeur de la clé primaire]
     *  @return     boolean
     *
     */
    public function deleteByPrimary($value_primary) {
        $sql = $this->database->prepare("DELETE FROM `{$this->table}` WHERE `{$this->primary}`=:primary");
        $sql->execute(array("primary" => $value_primary));
        return $this->returnAffectedRowBoolean($sql, true);
    }
    
    /**
     *  Méthode delete($where)
     *
     *  Supprime un élément de la base en fonction d'une condition
     * 
     *  @param      boolean     $where              [Condition à remplir]
     *  @return     boolean
     *
     */
    public function delete($where) {
        $sql = $this->database->prepare("DELETE FROM `{$this->table}` WHERE $where");
        $sql->execute();
        return $this->returnAffectedRowBoolean($sql, true); 
    }

    /**
     *  Méthode checkScheme($data)
     *
     *  
     *
     *  @param
     *  @return     array|string
     *
     */
    public function checkScheme($data) {
        foreach($data as $dataKey => $dataValue) {
            if(array_key_exists($dataKey, $this->scheme)) {
                switch ($this->scheme[$dataKey]) {
                    case 'string': 
                        if(empty($dataValue)) {
                            return "$dataKey is empty";
                        }
                        break;
                    default:
                        break;
                }
            }
            elseif($dataKey == $this->primary) {
                continue;
            }
            else {
                unset($data[$dataKey]);
            }
        }
        foreach($this->scheme as $field => $type){
            if(!array_key_exists($field, $data)){
                return "$field is required";
            }
        }
        return $data;
    }

    /**
     *  Méthode returnAffectedRowBoolean($query, $strict)
     *
     *  Retourne true si le nombre de lignes affectées est non nul sinon false
     * 
     *  @param  /PDO            $query              [ObjectPDO post execution]
     *  @param  boolean         $strict             [Retour strict ou non permet la prise en compte des requêtes n'affectant aucun élément]
     *  @return boolean
     *
     */
    protected function returnAffectedRowBoolean($query, $strict) {
        if ($query && (($strict && $query->rowCount()>0) || (!$strict && $query->rowCount()>=0))){
            return true;
        } 
        return false;
    }
}