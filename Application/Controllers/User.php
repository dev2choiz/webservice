<?php

namespace Application\Controllers;

/**
 *
 *
 */
class User extends \Library\Controller\Controller {
    
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
     *  Méthode authentification($params)
     *  Récupère recoit des ids, et verifie si le mdp et l'id correspondent
     *  
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function authentification($params) {      //Recu en POST
        unset($params['method']);
        
        //$params=get_object_vars( json_decode($params['params']) );
        
        

        $modelUser  = new \Application\Models\User();
        // l'utilisateur se logue avec son adresse mail et son mot de passe
        $mail       = (empty($params["mail"]))? null : $params["mail"];
        $password   = (empty($params["password"]))? null : $params["password"];
        $nom        = (empty($params["nom"]))? null : $params["nom"];
        $prenom     = (empty($params["prenom"]))? null : $params["prenom"];

        // on vérifie l'existence de valeurs non nulles pour les paramètres obligatoires
        if(is_null($mail)) { 
            return $this->setApiResult(false, true, "Param mail attendu"); 
        }
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) { 
            return $this->setApiResult(false, true, "Mail invalide, nous attendons : XXX@YYY.ZZZ"); 
        }

        // hasher le mot de passe transmis
        $passwordmd5 = md5($password.SALT_PASSWORD);
        // récupérer l'utilisateur courant
        $where  = "`mail`='{$mail}' AND `password`='{$passwordmd5}'";
        //echo $where;
        //$fields = "`nom`, `prenom`";
        $user   = $modelUser->fetchAll($where);

        //var_dump ($user);
        //$user=get_object_vars($user[0]);
        var_dump ($user);
        //die();
        if(!(count($user)==1 && !empty($user[0]))) { return $this->setApiResult(false, true, "Invalid mail or password"); }

        unset($user['password']);

        return $this->setApiResult($user);
    }






    public function getUser($params) {
        unset($params['method']);
        
        
        

        $modelUser  = new \Application\Models\User();

        // récupérer l'utilisateur 
        $where  = " `mail`='{$params['mail']}' ";
        $user   = $this->convEnTab( $modelUser->fetchAll($where) );
        
        var_dump ($user);
        //die();
        if(!(count($user)==1 && !empty($user[0]))) { return $this->setApiResult(false, true, "Mail non trouvé"); }

        unset($user['password']);

        return $this->setApiResult($user);
    }




    public function redefinirPassword($params) {
        unset($params['method']);
        //$this->setMode('brut');

        $modelUser  = new \Application\Models\User();
        $modelMailer  = new \Application\Models\Mailer();
        $req=" `mail`='".$params['mail'] . "' AND `reponsesecrete`='".$params['reponsesecrete'] . "'  ";
        echo $req;
        $user=$this->convEnTab($modelUser->fetchAll($req)[0]);
        //var_dump("user",$user);
        //$user=$user[0];
        
        
        if( empty($user) || ($user['reponsesecrete']!==$params['reponsesecrete'])  ){
            return $this->setApiResult(false, true, "la reponse secrete ne correspond pas a ce que nous avons en base");
        }

        $newPwd = uniqid();       // new password a definir aleatoirement et envoyer par mail

        echo " `mail`=".$params['mail']."<br>";
        $newPwdMd5 = md5($newPwd.SALT_PASSWORD);
        
        $res=$modelUser->update(" `mail`='".$params['mail']."'" , array("password"=> $newPwdMd5) );

        var_dump($res);
        if(  $res  ) {
            
            /*$mailExped="fourneaux@yahoo.fr";
            $mailDest=$params['mail'];
            $subject="94 tu peux pas test!!!";
            $body="mot de passe : ".$newPwd;
            $template="default";
            //envoi du mail
            echo "envoi du mail : ".$modelMailer->envoyerMail( $mailExped, $mailDest, $body, $subject, $template );*/


            //echo "#########################";
            return $this->setApiResult($newPwd);
        }else{
            return $this->setApiResult(false, true, "Le mot de passe n'a pas pu etre changé");
        }
    }





    /**
     *  Méthode post($params)
     *
     *  Crée un utilisateur avec les paramètres de la requête POST
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function insertUser($params) {         //

        unset($params['method']);
        $modelUser  = new \Application\Models\User();

        //$params=$modelUser->convEnTab(json_decode($params['params']));

        var_dump($params);
        
        // l'utilisateur s'enregistre dans la base de données avec ses informations
        $mail       = (empty($params["mail"]))? null : $params["mail"];
        $password   = (empty($params["password"]))? null : $params["password"];
        $nom        = (empty($params["nom"]))? null : $params["nom"];
        $prenom     = (empty($params["prenom"]))? null : $params["prenom"];
        $pseudo     = (empty($params["pseudo"]))? null : $params["pseudo"];


        // on vérifie l'existence de valeurs non nulles pour les paramètres obligatoires
        if(is_null($mail)) { 
            return $this->setApiResult(false, true, "Param mail is required on method post"); 
        }
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) { 
            return $this->setApiResult(false, true, "expecting XXX@YYY.ZZZ pattern for mail on method post."); 
        }
        if(is_null($password)) { 
            return $this->setApiResult(false, true, "Param password is required on method post"); 
        }

        // hasher le mot de passe transmis
        $passwordmd5 = md5($password.SALT_PASSWORD);

        // vérifier unicité de l'adresse mail
        $where = "`mail`='{$mail}'";
        $user = $modelUser->fetchAll($where);
        if(!empty($user)) { return $this->setApiResult(false, true, "L'adresse mail :  {$mail} existe déjà en base. Vous devez en choisir une autre!"); }

        $params['password'] = $passwordmd5;
        $params['pseudo'] = $pseudo;
        $params['role'] = 'membre';
        var_dump($params);
        $user = $modelUser->insertWithReturn($params);
        if(is_string($user)){
            return $this->setApiResult(false, true, $user);
        }
        return $this->setApiResult($user);
    }

    /**
     *  Méthode put($params)
     *
     *  Met à jour un utilisateur avec les paramètres de la requête PUT
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function updateUser($params){
        unset($params['method']);
        var_dump($params);
        $verifPassword = $params['verifpassword'];      unset($params['verifpassword']);
        $verifMail = $params['verifmail'];              unset($params['verifmail']);
        $modelUser  = new \Application\Models\User();
        //$params=$modelUser->convEnTab( json_decode( $params['params']) );
        
        
        $verifPasswordmd5=md5($verifPassword.SALT_PASSWORD);
        $where = "`mail`='{$verifMail}' AND `password`='{$verifPasswordmd5}' ";
        $user = $modelUser->fetchAll($where);
        

        if(empty($user)) { return $this->setApiResult(false, true, "Mot de passe invalide"); }      //0% de chance
        echo "verification du mot de passe actuel OK";

        // verifie si l'utilisateur a rentré un mail vide
         
        //Si on essaie de modifier le mail
        if(!empty($params["mail"]) ){

            if ($params["mail"]===$verifMail) {
                //si 
                unset($params["mail"]);
            }  else {

                $mail       = $params["mail"];

                // on vérifie l'existence de valeurs non nulles pour les paramètres obligatoires
                if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) { 
                    return $this->setApiResult(false, true, "le format du mail doit correspondre à : XXX@YYY.ZZZ"); 
                }

                // vérifier que la nouvelle adresse mail n'existe pas déjà pour un autre utilisateur
                $where = "`mail`='{$mail}' AND `mail` != '{$verifMail}'";
                $user = $modelUser->fetchAll($where);
                //var_dump('user', $where, $user);

                if(!empty($user)) { 
                    return $this->setApiResult(false, true, "Mail address {$mail} already exists in database. Please choose another mail address!"); 
                }
                echo "Le mail n'existe pas dans la base, (sauf si c'est le mail de l'user actuel, dans ce cas, il n'y a pas de modification du mail)";

            }
        }else{
            return $this->setApiResult(false, true, "le mail ne peut pas être vide"); 
        }


        // hasher le mot de passe transmis
        
        if(!empty($params["password"])){
            if (strlen($params["password"])<5) {
                return $this->setApiResult(false, true, "le mot de passe doit contenir au moins 5 caractères"); 
            }
            if(!empty($params['confpassword']) && $params['confpassword'] !== $params['password']){
                return $this->setApiResult(false, true, "la confirmation du mot de passe n'est pas identique au mot de passe"); 
            }


            $params['password'] = md5($params["password"].SALT_PASSWORD);

        }
        
        /*if(!empty($params["date_naissance"])){
        }*/



        unset($params['confpassword'], $params['currentpassword']);
        var_dump($params);
        $result = $modelUser->update(" `mail`='$verifMail' AND `password`='$verifPasswordmd5' ", $params);
        echo "`mail`=$verifMail AND `password`='$verifPasswordmd5'";
        
        if(!$result){
            return $this->setApiResult(false, true, "erreur lors de la mise a jour des donnees.<br> le mot de passe est peut etre invalide");
        }
        return $this->setApiResult(true);

    }

    /**
     *  Méthode delete()
     *
     *  Supprime l'utilisateur de la base en fonction de sa clé primaire ou de son mail transmise dans la requête DELETE
     *  
     *  @param      string|int  $data    [id_user ou mail de la table user]
     *  @return     array
     *
     */
    public function deleteUser($params) {

        var_dump($params);
        unset($params['method']);
        
        $idUser=$params['id_user'];
        $password=$params['password'];
        
        $modelUser  = new \Application\Models\User();
        

        $where = "`id_user`={$idUser} ";
        $user = $modelUser->fetchAll($where);
        if(empty($user)) { return $this->setApiResult(false, true, "L'utilisateur n'existe pas"); }

        //verifie si le mot de passe est bon
        $passwordmd5=md5($password.SALT_PASSWORD);
        $where = "`id_user`={$idUser} AND `password`='{$passwordmd5}' ";
        $user = $modelUser->fetchAll($where);
        echo "`id_user`='{$idUser}' AND `password`='{$passwordmd5}' ";
        if(empty($user)) { return $this->setApiResult(false, true, "Mot de passe ne correspond pas à l'utilisateur renseigné"); }
        

        //on suppr

        $deleted        = $modelUser->delete(" `id_user`={$params['id_user']} ");

        if(!$deleted) { 
            return $this->setApiResult(false, true, array(
                "error" => "User of id_user {$data['id_user']} not found",
                "data" => $params
            ));
        }
        return $this->setApiResult($deleted);
    }
    
}