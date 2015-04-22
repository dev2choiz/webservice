<?php

namespace Application\Controllers;

/**
 *
 *
 */
class Produit extends \Library\Controller\Controller {
    
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
    *  Méthode post($params)
    *
    *  Crée une recette avec les paramètres de la requête POST       
    *  @param      array       $params     [données de requête]
    *  @return     array
    *
    */
    public function getAllProduits() {

        $modelProduit  = new \Application\Models\Produit();
        $res=$modelProduit->fetchAll();
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des produit");
        }

    }

    public function getProduit($params) {
        unset($params['method']);



        $modelProduit  = new \Application\Models\Produit();
        $res=$modelProduit->fetchAll(" `id_produit`='{$params['id_produit']}' ");
        var_dump($res);
            
        if( !empty( $res ) ) {
            return $this->setApiResult( $res[0]);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des produit");
        }

    }

    public function getTopProduits($params) {
        unset($params['method']);

        $modelProduit  = new \Application\Models\Produit();
        $res = $modelProduit->fetchAll(" `top`='1' OR  `top`='2' OR  `top`='3' ");
           
        if( !empty( $res ) ) {
            return $this->setApiResult($res);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la recuperation des produit");
        }

    }

    public function insertProduit($params) {

        unset($params['method']);
        //var_dump($params);

        $modelProduit  = new \Application\Models\Produit();
        $this->setMode("brut");     //pour pouvoir lancer une fonction js du webservice   




        //verification des champs
        echo "prix avant = ".$params['prix'];
        $params['top']="0";
        $params['prix']=floatval($params['prix']);
        if(($params['prix']+0)>2000000){
            $error="le prix est trop elevé";
            echo '
            <script type="text/javascript">
                window.top.window.finUpload("'.$error.'", 0);
            </script>';
            return $this->setApiResult(false, true, "le prix est trop elevé");
        }


        //###################################################### reste a 10 pas
        
        $targetpath='';
        $error    = NULL;
        $filename = NULL;
        var_dump("dolfile",$_FILES);
        if ( isset($_FILES['img']) && $_FILES['img']['error'] === 0 ) {
            //echo 'dans le if<BR>';
            $filename = $this->retirerCaractereSpeciaux($params['value']);
            $targetpath = IMG_ROOT."produit/". $filename.'.jpg'; // On stocke le chemin où enregistrer le fichier
            echo $filename."<BR>".$targetpath."<br>".$_FILES['img']['tmp_name']."<br>";
            // On déplace le fichier depuis le répertoire temporaire vers $targetpath
 
            if (@move_uploaded_file($_FILES['img']['tmp_name'], $targetpath)) { // Si ça fonctionne
                $error = 'non';
                $params['img']="produit/". $filename.'.jpg';
            }else{ // Si ça ne fonctionne pas
                $error = "Échec de l'enregistrement !";
            }
        } else {
            $error= 'Aucun fichier réceptionné !';
        }

        





        var_dump("params",$params);
        $res=$modelProduit->insert($params);
        echo "DLD".$res."##";




        if( $res>0  ) {

            echo '
            <script type="text/javascript">
                window.top.window.finUpload("'.$error.'", '.$modelProduit->getLast().');
            </script>';
            
            return $this->setApiResult(true);
        }else{
            echo '
            <script type="text/javascript">
                window.top.window.finUpload("'.$error.'", 0);
            </script>';
            return $this->setApiResult(false, true, "erreur pendant l'ajout du produit");
        }


    }

     /**
     *  Méthode post($params)
     *
     *  Crée une recette avec les paramètres de la requête POST
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function updateProduit($params) {


        unset($params['method']);

        if(!empty($params['prix'])){
            $params['prix']=$params['prix']+0;
        }
        //var_dump();
        $modelProduit  = new \Application\Models\Produit();

        if($modelProduit->update(" `id_produit`='{$params['id_produit']}' ", $params) ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la mise a jour");
        }
    }

    /**
     *  Méthode post($params)
     *
     *  Crée une recette avec les paramètres de la requête POST
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function deleteProduit($params) {         //delete une recette


        unset($params['method']);

        $modelProduit  = new \Application\Models\Produit();


        if($modelProduit->delete(" `id_produit`='{$params['id_produit']}' ") ) {

            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression des produit");
        }
    }




    
    /*
    public function recupererScriptNewProduit($params){

        unset($params['method']);

        $modelProduit  = new \Application\Models\Produit();
        $modelPopUpProduit  = new \Application\Models\PopUpProduit();

        $produit=$modelProduit->convEnTab($modelProduit->fetchAll(" `id_produit`={$params['id_produit']} ") );
        $produit=$produit[0];


        if(!empty($produit) ) {
            $script=$modelPopUpProduit->getPopup(   $produit['id_produit'],
                                        $produit['prix'],
                                        $produit['ref'],
                                        $produit['value']);



            $html="
                    <div>
                        <div class='row' id='WrapperProduit{$produit['id_produit']}'>
                            <div class='col-md-4'>
                            
                                <a href='".LINK_ROOT.'vente/produit/'.$produit['id_produit']."'>Produit : <span id='labelValueProduit'>{$produit['value']}</span></a>

                            </div>
                            <div class='col-md-4'>
                                Prix : <span id='labelPrixProduit'>{$produit['prix']}</span> €
                                Référence : <span id='labelRefProduit'>{$produit['ref']}</span>
                            </div>
                            

                            <div >
                                <div id='wrapperImgProduit'>
                                    <img src='{$produit['img']}' id='imgProduit'  alt='Image produit' style='width:150px; height:150px;' />
                                </div>
                                <button class='btn btn-primary btn-xs col-md-offset-3 popupProduit' id='popupProduit{$produit['id_produit']}' >Modifier ce Produit</button>
                                <div class='row'>
                                    $script
                                </div>

                            </div>
                            
                        </div>
                    </div>";

            return $this->setApiResult($html);
        }else{
            return $this->setApiResult(false, true, "Le produit n'existe pas");
        }
    }*/




    public function getImageProduit($params) {
        
        unset($params['method']);

        $modelProduit  = new \Application\Models\Produit();
        
        $res=$modelProduit->convEnTab($modelProduit->fetchAll("`id_produit`='{$params['id_produit']}'"));
            var_dump("getimageproduit",$res);
            
        if(  !empty($res)  ) {
            return $this->setApiResult($res[0]['img']);
        }else{
            return $this->setApiResult(false, true, "produit non trouvée");
        }


    }



    public function envoiImageProduit($params) {
        
        $this->setMode("brut");

        unset($params['method']);

        $modelProduit  = new \Application\Models\Produit();
        
        $targetpath='';
        $error    = NULL;
        $filename = NULL;
        //var_dump("sfiles",$_FILES);
        if ( isset($_FILES['img']) && $_FILES['img']['error'] === 0 ) {

            $filename = $_FILES['img']['name'];
            $targetpath = IMG_ROOT ."produit/". $filename; // On stocke le chemin où enregistrer le fichier
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



        
        $idProd = $params['id_produit'];
        unset($params['id_produit']);
        $params['img']="/img/produit/".$filename;
        //echo '{{'.$params['img'];
        $res = $modelProduit->update(" `id_produit`=$idProd ", $params);

        if(  $res  ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant l'ajout de l'image au produit");
        }

    }











}