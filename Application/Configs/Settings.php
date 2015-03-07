<?php

namespace Application\Configs;

/**
 *
 *
 */
class Settings {
    
    // Notre classe devient un singleton grace à l'utilisation du trait singleton
    use \Library\Traits\Patterns\Singleton;
    
    /**
     * Base URL
     * @var string
     */
    private static $baseUrl = null;
    
    /**
     *  Méthode __construct()
     *
     *  Constructeur par défaut
     *
     *  @param
     *  @return     void
     *
     */
    function __construct() {
        
    }
    
    /**
     *  Méthode setBaseUrl($url)
     *
     *  Setter de $baseUrl
     *
     *  @param      string      $url            [URL de base]
     *  @return     void
     *
     */
    public static function setBaseUrl($url) {
        self::$baseUrl = $url;
    }
    
    /**
     *  Méthode readSettings()
     *
     *  Initialise les variables globales WEB_ROOT, LINK_ROOT, APP_ROOT, LIB_ROOT et SALT_PÄSSWORD 
     *
     *  @param
     *  @return     void
     *
     */
    public static function readSettings() {

        if(is_null(self::$baseUrl)){
            throw new \Exception("baseUrl in " . __CLASS__ . " is Null");
        }

        /**
         * WEB_ROOT     /qcm/webservice/Public/
         * LINK_ROOT    http://localhost/qcm/webservice/
         * APP_ROOT     C:/wamp/www/qcm/webservice/Application
         * LIB_ROOT     C:/wamp/www/qcm/webservice/Library
         */
        
        // Lien vers notre dossier public
        define('WEB_ROOT', str_replace('index.php', '', $_SERVER["SCRIPT_NAME"]));
        // Base URL
        define('LINK_ROOT', str_replace('Public/index.php', '', self::$baseUrl . $_SERVER["SCRIPT_NAME"]));
        // Dossier application
        define('APP_ROOT', str_replace('Public/index.php', 'Application/', $_SERVER["SCRIPT_FILENAME"]));
        // Dossier library
        define('LIB_ROOT', str_replace('Public/index.php', 'Library/', $_SERVER["SCRIPT_FILENAME"]));
        
        define('SALT_PASSWORD', 'X_ ##8[+VN7hWcmeOhHzbhaP$_I|C{-7=8Oy$W^VH(?}bRGndcM{%2r]}d?NH]6N');
    }
}