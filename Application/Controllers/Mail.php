<?php

namespace Application\Controllers;

/**
 *
 * Mail
 */
class Mail {
    
    /**
     *  Méthode __construct()
     *
     *  Constructeur par défaut appelant le constructeur de Library\Controller\Controller
     *
     */
    public function __construct() {
        parent::__construct();
    }


    /**
     *  Méthode getcategories
     *
     *  retourne les categories
     *       
     *  @return     array
     *
     */
    public function forgottenpassword($params) {
        unset($params['method']);

        $modelUser  = new \Application\Models\User('localhost');

        $user=$modelUser->fetchAll("`id_user`=".$params['id_user']);
        $user=$user[0];
        if($user['userreponse']!==$params['userreponse']){
            return $this->setApiResult(false, true, "la reponse secrete ne correspond pas a ce que nous avons en base");
        }

        $newPwd = "password";       // password a envoyer par mail

        $newPwdMd5 = md5($newPwd.SALT_PASSWORD);
        $res=$modelUser->update(array("password", $newPwdMd5),"`id_user`=".$params['id_user']);
        
        if(  $res  ) {
            return $this->setApiResult( $res);
        }


    }




}