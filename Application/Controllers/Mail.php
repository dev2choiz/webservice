<?php


namespace Application\Controllers;

require_once(APP_ROOT."/Models/PhpMailer/_lib/class.smtp.php");
require_once(APP_ROOT."/Models/PhpMailer/_lib/class.phpmailer.php");

/**
 * Mail
 */
class Mail extends \Library\Controller\Controller {
    
    /**
     *  Méthode __construct()
     *
     *  Constructeur par défaut appelant le constructeur de Library\Controller\Controller
     *
     */
    public function __construct() {
        parent::__construct();

        //echo ini_set("SMTP","smtp.free.fr" )."<br>";    //a la baraque
        //echo ini_set("SMTP","smtp.gmail.com" )."<br>";    //au taff
        //echo ini_set("SMTP","gmail-smtp-in.l.google.com" )."<br>";    //au taff
        /*echo ini_set("SMTP", "smtp.mail.yahoo.fr" )."<br>";    //marche toupar
        echo ini_set('smtp_port',587)."<br>";
        echo ini_set('auth_username','fourneaux@yahoo.fr')."<br>";
        echo ini_set('auth_password','acnologia')."<br>";
        echo ini_set("sendmail_from","fourneaux@yahoo.fr" )."<br>";*/

    }

    public function testMail($params){
        
        $this->setMode('brut');
        $mailExped="fourneaux@yahoo.fr";
        $mailDest="dev2choiz@gmail.com";
        $body="94 tu peux pas test!!!";
        $subject="DD";
        return $this->envoyerMail($mailExped, $mailDest, $body, $subject, "default");
    }



public function redefinirPassword($params) {
        unset($params['method']);

        $modelUser  = new \Application\Models\User('localhost');

        $user=$modelUser->fetchAll("`id_user`=".$params['id_user']);
        $user=$user[0];
        if($user['userreponse']!==$params['userreponse']){
            return $this->setApiResult(false, true, "la reponse secrete ne correspond pas a ce que nous avons en base");
        }

        $newPwd = "password";       // new password a definir aleatoirement et envoyer par mail

        $newPwdMd5 = md5($newPwd.SALT_PASSWORD);
        $res=$modelUser->update(array("password", $newPwdMd5)," `id_user`=".$params['id_user'] );
        
        if(  $res  ) {

            return $this->setApiResult( $res);

        }else{
            return $this->setApiResult(false, true, "Le mot de passe n'a pas pu etre changé");
        }
    }





}