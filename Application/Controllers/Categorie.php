<?php

namespace Application\Controllers;

/**
 *
 * Categorie
 */
class Categorie extends \Library\Controller\Controller {
    
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
    public function getcategories() {         //ajouter une recette




        $modelCategorie  = new \Application\Models\Categorie('localhost');
        $res=$modelCategorie->getCategories();
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des categories");
        }


    }



    /**
     * [insertcategorie description]
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    public function insertcategorie($params) {
        
        unset($params['method']);

        $modelCategorie  = new \Application\Models\Categorie('localhost');
        
        $res=$modelCategorie->insert($params);
            
        if(  $res  ) {
            return $this->setApiResult($modelCategorie->getLast());
        }else{
            return $this->setApiResult(false, true, "erreur pendant l'insertion de la catégorie");
        }


    }




    public function updatecategorie($params) {
        
        unset($params['method']);

        $modelCategorie  = new \Application\Models\Categorie('localhost');
        
        $res=$modelCategorie->update(" `id_cat`='{$params['id_cat']}'", $params);
            
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la modification de la catégorie");
        }


    }




    public function deletecategorie($params) {
        
        unset($params['method']);

        $modelCategorie  = new \Application\Models\Categorie('localhost');
        
        $res=$modelCategorie->delete("`id_cat`='{$params['id_cat']}'");
            
        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression de la catégorie");
        }


    }


    public function getimagecategorie($params) {
        
        unset($params['method']);

        $modelCategorie  = new \Application\Models\Categorie('localhost');
        
        $res=$modelCategorie->convEnTab($modelCategorie->fetchAll("`id_cat`='{$params['id_cat']}'"));
            var_dump("getimagecategorie",$res);
            
        if(  !empty($res)  ) {
            return $this->setApiResult($res[0]['img']);
        }else{
            return $this->setApiResult(false, true, "categorie non trouvée");
        }


    }



    public function envoiimagecategorie($params) {
        
        $this->setMode("brut");

        unset($params['method']);

        $modelCategorie  = new \Application\Models\Categorie('localhost');
        
        $targetpath='';
        $error    = NULL;
        $filename = NULL;
        //var_dump("sfiles",$_FILES);
        if ( isset($_FILES['img']) && $_FILES['img']['error'] === 0 ) {


            
            $filename=$this->convEnTab( $modelCategorie->fetchAll( " `id_cat`='{$params['id_cat']}' " ) );
            $filename=$this->retirerCaractereSpeciaux($filename[0]['value']).'.jpg';


            //$filename = $_FILES['img']['name'];
            $targetpath = IMG_ROOT ."categorie/". $filename; // On stocke le chemin où enregistrer le fichier
            echo $filename;
            // On déplace le fichier depuis le répertoire temporaire vers $targetpath
            if (@move_uploaded_file($_FILES['img']['tmp_name'], $targetpath)) { // Si ça fonctionne
                $error = 'non';
            } else { // Si ça ne fonctionne pas
                $error = "Échec de l'enregistrement !";
            }
        } else {
            $error = 'Aucun fichier réceptionné !';
        }

        // Et pour finir, on écrit l'appel vers la fonction uploadEnd : 
        ?>
        <script type="text/javascript">
            window.top.window.finUpload("<?php echo $error; ?>", "<?php echo $filename; ?>");
        </script>
        <?php



        
        $idCat=$params['id_cat'];
        unset($params['id_cat']);
        $params['img']="/img/categorie/".$filename;
        //echo '{{'.$params['img'];
        $res=$modelCategorie->update(" `id_cat`=$idCat ", $params);
          
        /*ob_end_clean();
        if(  $res  ) {

            echo  "true";
        }else{
            echo "false";
        }        
        die();die();*/

        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant l'ajout de l'image à la catégorie");
        }

    }

}