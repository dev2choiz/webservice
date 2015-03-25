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
        $mailExped="fourneaux@yahoo.fr";
        $mailDest="dev2choiz@gmail.com";
        $body="94 tu peux pas test!!!";
        $subject="DD";
        return $this->envoyerMail($mailExped, $mailDest, $body, $subject, "default");
    }

    /**
     * [envoyerMail qui envoit des mails : ne doit pas etre appellé par le client]
     * @param  [type] $mailExped [description]
     * @param  [type] $mailDest  [description]
     * @param  [type] $body      [description]
     * @param  [type] $subject   [description]
     * @param  [type] $template  [description]
     * @return [type]            [description]
     */
    public function envoyerMail($mailExped, $mailDest, $body, $subject, $template){
        $this->setMode('brut');
        

        $mail = new \PhpMailer\phpmailer();
        $mail->IsSMTP();
        $mail->IsHTML(true);
        //$mail->SMTPDebug = 2; 

        $mail->SMTPAuth = true;

        $mail->Host = "ssl://188.125.69.59:465"; // SMTP server
        //$mail->Host = "smtp.mail.yahoo.fr"; // SMTP server
        
        $mail->Username = "fourneaux@yahoo.fr";
        $mail->Password = "acnologia"; 

        $mail->From=$mailExped;
        $mail->Subject = $subject;

        
        $tpl=APP_ROOT."/Models/ViewMail/".$template.".phtml";
        echo $tpl;

        if(file_exists($tpl)){
            echo "ici  sjkqhj";
            ob_start(); //lance au cas ou ca ne le serait pas
            $save=ob_get_clean();
            ob_start();
            $content_mail = $body;
            include($tpl);
             $tmp=ob_get_contents();
            $mail->Body = ob_get_clean();  //contient le contenu du mail a l'interieur du template

            echo $save."#".$mail->Body.$tmp;;     //remet le contenu du buffer qui n'a pas eté arreté
        }else{
            $mail->Body = $body;
        }
        

        $mail->AddAddress($mailDest);
        //$mail->AddReplyTo($mailDest);
        
        if( @(!$mail->Send() ) ){
            echo "message non envoyé";
            $mail->SmtpClose();
            return $this->setApiResult( false, true, "Le mail n'a pas pu être envoyé ".$mail->ErrorInfo);
        }else{
            echo "message envoyé";
            $mail->SmtpClose();
            return $this->setApiResult(true);
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