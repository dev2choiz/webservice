<?php

namespace Library\Loader;
require_once(str_replace('Loader', 'Traits/Patterns/Singleton.php', __DIR__));

/**
 * Classe permettant le chargement automatique des services
 *
 *
 */
class Autoloader {
    
    // Notre classe devient un singleton grace à l'utilisation du Trait Singleton
    use \Library\Traits\Patterns\Singleton;

    /**
     * Chemin racine du site ou de l'application sur le serveur
     * @var string
     */
    private static $basePath = null;

    /**
     *  Méthode __construct()
     *
     *  Constructeur par défaut
     *
     *  @param
     *  @return     void
     *
     */
    private function __construct(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     *  Méthode setBasePath($path)
     *
     *  Setter de $basePath
     *
     *  @param      string      $path       [Chemin racine du site ou de l'application sur le serveur]
     *  @return     void
     * 
     */
    public static function setBasePath($path){
        self::$basePath = $path;
    }


    /**
     *  Méthode autoload($class)
     *
     *  Autoloader
     * 
     *  @param      string      $class      [Nom de la classe à instancier]
     *  @return     void
     *
     */
    protected static function autoload($class){
        //echo __CLASS__.$class;
        if ( !preg_match("/phpmailer/",strtolower($class)) ) {
       
        if(is_null(self::$basePath)){
            throw new \Exception("basePath in" . __CLASS__ . " is Null");
        }else{
         $pathFile = self::$basePath . str_replace('\\', DIRECTORY_SEPARATOR, $class) . ".php";
        require_once($pathFile);
            }
        }
        /*$pathFile = self::$basePath . str_replace('\\', DIRECTORY_SEPARATOR, $class) . ".php";
        require_once($pathFile);*/
    }
}