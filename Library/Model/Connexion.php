<?php

namespace Library\Model;

/**
 *
 *
 */
class Connexion {

    use \Library\Traits\Patterns\Singleton;

    /**
     * Tableau d'objets PDO qui représente chacun une connexion mysql
     * @var array object \PDO
     */
    private static $listConnexions;
    
    /**
     *  Méthode __construct()
     *
     *  Constructeur par défaut
     * 
     *  @param      
     *  @return     void
     *
     */
    private function __construct() {
        
    }

    /**
     *  Méthode getConnexion($name)
     *
     *  Renvoie l'objet PDO correspondant à la connexion ayant pour nom $name
     * 
     *  @param      string      $name       [nom de la connexion à rechercher]
     *  @return     object \PDO
     *
     */
    public static function getConnexion($name) {
        if(!array_key_exists($name, self::$listConnexions)){
            throw new \Exception("Connexion name:'$name' not found");
        }
        return self::$listConnexions[$name];   
    }
    
    /**
     *  Méthode getListConnexionsName()
     *
     *  Renvoie un tableau des noms des connexions
     * 
     *  @param
     *  @return     array
     *
     */
    public static function getListConnexionsName() {
        return array_keys(self::$listConnexions);
    }
    
    /**
     *  Méthode connectDB($host, $dbname, $user, $password, $charset="UTF8")
     *
     *  Connecte à la base de données mysql via l'objet PDO
     * 
     *  @param      string      $host       [Adresse du serveur de base de données]
     *  @param      string      $dbname     [Nom de la base de données]
     *  @param      string      $user       [Utilisateur mysql]
     *  @param      string      $password   [Mot de passe de l'utilisateur mysql]
     *  @param      string      $charset    [Charset de connexion]
     *  @return     object \PDO
     *
     */
    public static function connectDB($host, $dbname, $user, $password, $charset="UTF8") {
        //echo "mysql:host=$host;dbname=$dbname <br>";
        $database = new \PDO("mysql:host
            =$host;dbname=$dbname", $user, $password);
        $database->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        $database->exec("SET CHARACTER SET $charset");
        
        return $database;
    }
    
    //
    /**
     *  Méthode getConnexion($name)
     *
     *  Ajoute une nouvelle connexion à la liste des connexions
     * 
     *  @param      string      $connexionName      [Nom de la connexion à ajouter]
     *  @param      object \PDO $objectPDO          [Connexion mysql]
     *  @return     void
     *
     */
    public static function addConnexion($connexionName, $objectPDO) {
        self::$listConnexions[$connexionName] = $objectPDO;
    }
}