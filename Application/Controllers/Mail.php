<?php


namespace Application\Controllers;

//require_once(LIB_ROOT."Models/PhpMailer/_lib/class.smtp.php");
//require_once(LIB_ROOT."Models/PhpMailer/_lib/class.phpmailer.php");

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

        // echo ini_set("SMTP","smtp.free.fr" )."<br>";
        echo ini_set("SMTP","ssl://smtp.gmail.com" )."<br>"; 
        // echo ini_set("SMTP", "smtp.mail.yahoo.fr" )."<br>";
        // echo ini_set("SMTP","gmail-smtp-in.l.google.com" )."<br>";
        //echo ini_set('smtp_port',587)."<br>";
        echo ini_set('smtp_port',"465")."<br>";

        echo ini_set("sendmail_from","chefdesfourneaux@gmail.com" )."<br>";
        echo ini_set("auth_username", "chefdesfourneaux@gmail.com");
        echo ini_set("auth_password", "Fourneaux1234");
        

        //echo ini_set("sendmail_from","chefdesfourneaux@gmail.com" )."<br>";
        //phpinfo();

        if (!extension_loaded('openssl')) {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                dl('php_openssl.dll');
            } else {
                dl('openssl.so');
            }
        }


    }

    public function envoyerMail($params){
        

        

        $this->setMode('brut');

        unset($params['method']);
        $modelMailer  = new \Application\Models\Mailer();

        $mailExped      = $params['expediteur'];
        $mailDest       = $params['destinataires'];
        $body           = $params['body'];
        $subject        = $params['subject'];
        $template       = $params['template'];

        /*$mailExped="fourneaux@yahoo.fr";
        $mailDest="dev2choiz@gmail.com";
        $body="94 tu peux pas test!!!";
        $subject="DD";
        $template="default";*/

        
        if( $modelMailer->envoyerMail( $mailExped, $mailDest, $body, $subject, $template) ){
            return $this->setApiResult( true);
        }else{
            return $this->setApiResult(false, true, "mail non envoyé");
        }
        
    }




    public function testMail($params){

        $modelMailer  = new \Application\Models\Mailer();
        
        $this->setMode('brut');
        $mailExped="fourneaux@yahoo.fr";
        $mailDest="dev2choiz@gmail.com";
        $body="94 tu peux pas test!!!";
        $subject="DD";
        

        if( $modelMailer->envoyerMail($mailExped, $mailDest, $body, $subject, "default") ){
            return $this->setApiResult( true);
        }else{
            return $this->setApiResult(false, true, "mail non envoyé");
        }

    }



public function redefinirPassword($params) {
        unset($params['method']);

        $modelUser  = new \Application\Models\User();

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