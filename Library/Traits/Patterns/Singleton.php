<?php

namespace Library\Traits\Patterns;

trait Singleton {

    /**
     * Variable contenant l'instance courante
     * @var null|object Library/Traits/Patterns/Singleton
     */
    private static $instance = null;
    
    /**
     *  Méthode getInstance()
     *
     *  Récupère l'instance courante de la classe utilisant Singleton
     *  
     *  @param
     *  @return     object Library/Traits/Patterns/Singleton
     *
     */
    public static function getInstance() {
        if(is_null(self::$instance)) {
            self::$instance= new self();
        }
        return self::$instance;
    }
}