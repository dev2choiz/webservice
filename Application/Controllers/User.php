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
        if (isset($params['params']))
            $params = get_object_vars( json_decode($params['params']) );

        unset($params['method']);
        //get_object_vars = transforme un objet en tableau
        
        

        $modelUser  = new \Application\Models\User('localhost');
        // l'utilisateur se logue avec son adresse mail et son mot de passe
        $mail       = (empty($params["mail"]))? null : $params["mail"];
        $password   = (empty($params["password"]))? null : $params["password"];
        $nom        = (empty($params["nom"]))? null : $params["nom"];
        $prenom     = (empty($params["prenom"]))? null : $params["prenom"];

        // on vérifie l'existence de valeurs non nulles pour les paramètres obligatoires
        if(is_null($mail)) { 
            return $this->setApiResult(false, true, "Param mail is required ".var_export($params, true)); 
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
    public function insertuser($params) {         //


        $modelUser  = new \Application\Models\User('localhost');

        $params=$modelUser->convEnTab(json_decode($params['params']));

        var_dump($params);
            
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

        $params['password']=$passwordmd5;
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


        $idUser     = $params['id_user'];
        $modelUser  = new \Application\Models\User('localhost');
        $params     = $modelUser->convEnTab( json_decode($params['params'])  );

        echo "lasd";
        $idUser=$params['id_user'];
        $currentPassword=$params['password'];
        $currentMail=$params['mail'];
        $modelUser  = new \Application\Models\User('localhost');
        $params=$modelUser->convEnTab( json_decode( $params['params']) );
        
        
        $currentPasswordmd5=md5($currentPassword.SALT_PASSWORD);
        $where = "`mail`='{$currentMail}' AND `password`='{$currentPasswordmd5}' ";
        $user = $modelUser->fetchAll($where);
        

        if(empty($user)) { return $this->setApiResult(false, true, "Mot de passe invalide"); }      //0% de chance
        echo "verification du mot de passe actuel OK";
 
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
        $where = "`mail`={$mail} AND `id_user`!={$idUser}";
        $user = $modelUser->fetchAll($where);
        //var_dump('user', $where, $user);

        if(!empty($user)) { 
            return $this->setApiResult(false, true, "Mail address {$mail} already exists in database. Please choose another mail address!"); 
        }


        if(!empty($user)) { return $this->setApiResult(false, true, "Mail address {$mail} already exists in database. Please choose another mail address!"); }
        echo "mail n'existe pas dans la base, (sauf si c'est le mail de l'user qu'on traite==>pas de modif du mail)";

        $result = array("mail" => $mail, "password" => $passwordmd5, "nom" => $nom, "prenom" => $prenom);
        
        $alors = $modelUser->update("`id_user`='$idUser' AND `password`='$currentPasswordmd5'", $result);
        var_dump($alors, "`id_user`=$idUser AND `password`='$passwordmd5'", $result);
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
    public function deleteuser($params) {


        unset($params['method']);
        
        $idUser=$params['id_user'];
        $password=$params['password'];
        
        $modelUser  = new \Application\Models\User('localhost');
        
        //verifie si le mot de passe est bon
        $passwordmd5=md5($password.SALT_PASSWORD);
        $where = "`id_user`='{$idUser}' AND `password`='{$passwordmd5}' ";
        $user = $modelUser->fetchAll($where);
        
        if(empty($user)) { return $this->setApiResult(false, true, "Mot de passe invalide"); }
        

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