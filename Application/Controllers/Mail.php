<?php

namespace Application\Controllers;

/**
 *
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
    }


    public function envoyerMail($params){
        
        $this->setMode('brut');
        
        
        echo ini_set("SMTP","smtp.free.fr" )."<br>";
        echo ini_set('smtp_port',25)."<br>";

        echo ini_set("sendmail_from","dev2choiz@gmail.com" )."<br>";
        
        $to      = 'dev2choiz@gmail.com';
        $subject = 'le sujet';
        $message = 'wesh BacchusSam !';
        $headers = 'From: sddam@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        

        if(mail($to, $subject, $message, $headers)){
            echo "dans if";
            return $this->setApiResult( true);
        }else{
            echo "dans else";
            return $this->setApiResult(false, true, "Le n'as pas pu être envoyé");
        }
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