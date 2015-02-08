<?php

namespace Application\Models;

/**
 *
 *
 */
class User extends \Library\Model\Model {
	
    /**
     * Nom de la table correspondant au modèle User
     * @var string
     */
    protected $table    = 'user';
    /**
     * Clé primaire de la table correspondant au modèle User
     * @var string
     */
    protected $primary  = 'id_user';
    /**
     * Ensemble des paramètres nécessaires pour valider les opérations GET, POST, PUT ou DELETE
     * @var array
     */
    protected $scheme   = array(            //a virer
        'prenom' => 'string',
        'nom' => 'string',
        'mail' => 'string',
        'password' => 'string',
    );

    /**
     *  Méthode __construct($connexionName)
     *
     *  Constructeur appelant le constructeur de Library\Model\Model et transmettant la connexion
     *
     *  @param      string      $connexionName          [Nom de la connexion]
     *
     */
    public function __construct($connexionName){
        parent::__construct($connexionName);
        parent::setPrimary($this->primary);
    }
}