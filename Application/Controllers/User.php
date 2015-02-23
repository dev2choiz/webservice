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
        //get_object_vars = transforme un objet en tableau
        $params=get_object_vars( json_decode($params['params']) );
        
        

        $modelUser  = new \Application\Models\User('localhost');
        // l'utilisateur se logue avec son adresse mail et son mot de passe
        $mail       = (empty($params["mail"]))? null : $params["mail"];
        $password   = (empty($params["password"]))? null : $params["password"];
        $nom        = (empty($params["nom"]))? null : $params["nom"];
        $prenom     = (empty($params["prenom"]))? null : $params["prenom"];

        // on vérifie l'existence de valeurs non nulles pour les paramètres obligatoires
        if(is_null($mail)) { 
            return $this->setApiResult(false, true, "Param mail is required on method get"); 
        }
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) { 
            return $this->setApiResult(false, true, "Invalid mail address : expecting XXX@YYY.ZZZ pattern for mail in method get."); 
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
        //var_dump ($user);
        //die();
        if(!(count($user)==1 && !empty($user[0]))) { return $this->setApiResult(false, true, "Invalid mail or password"); }

        unset($user['password']);
        return $this->setApiResult($user);
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
    public function post($params) {         //

        $modelUser  = new \Application\Models\User('localhost');
        // l'utilisateur s'enregistre dans la base de données avec ses informations
        $mail       = (empty($params["mail"]))? null : $params["mail"];
        $password   = (empty($params["password"]))? null : $params["password"];
        $nom        = (empty($params["nom"]))? null : $params["nom"];
        $prenom     = (empty($params["prenom"]))? null : $params["prenom"];


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
        if(!empty($user)) { return $this->setApiResult(false, true, "Mail address {$mail} already exists in database. Please choose another mail address!"); }

        $result = array("mail" => $mail, "password" => $passwordmd5, "nom" => $nom, "prenom" => $prenom);
        $user = $modelUser->insertWithReturn($result);
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

        $idUser     = $params['id_user'];
        $modelUser  = new \Application\Models\User('localhost');
        $params     = $modelUser->convEnTab( json_decode($params['params'])  );
        
        
 
        //$password=md5($params['password'].SALT_PASSWORD);

        //$user       = $modelUser->update("`id_user`=$id AND `password`='$password'", $params);

        // l'utilisateur s'enregistre dans la base de données avec ses informations
        $mail       = (empty($params["mail"]))? null : $params["mail"];
        $password   = (empty($params["password"]))? null : $params["password"];
        $nom        = (empty($params["nom"]))? null : $params["nom"];
        $prenom     = (empty($params["prenom"]))? null : $params["prenom"];


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

        // vérifier que la nouvelle adresse mail n'existe pas déjà pour un autre utilisateur
        $where = "`mail`={$mail}";//" AND `id_user`!={$params['id_user']}";
        $user = $modelUser->fetchAll($where);
        //var_dump('user', $where, $user);
        if(!empty($user)) { 
            return $this->setApiResult(false, true, "Mail address {$mail} already exists in database. Please choose another mail address!"); 
        }

        $result = array("mail" => $mail, "password" => $passwordmd5, "nom" => $nom, "prenom" => $prenom);
        //$user = $modelUser->updateByPrimary($result);
        $alors = $modelUser->update("`id_user`='$idUser' AND `password`='$passwordmd5'", $result);
        var_dump($alors, "`id_user`='$idUser' AND `password`='$password'", $result);
        if(!$alors){
            return $this->setApiResult(false, true, "erreur lors de la mise a jour des donnees");
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
    public function delete($data) {
        $modelUser      = new \Application\Models\User('localhost');
        $deleted        = $modelUser->deleteByPrimary($data['id_user']);
        if(!$deleted) { 
            return $this->setApiResult(false, true, array(
                "error" => "User of id_user {$data['id_user']} not found",
                "data" => $data
            ));
        }
        return $this->setApiResult($deleted);
    }
}