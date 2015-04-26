<?php

namespace Library\Core;

/**
 * 	Classe instanciant un objet de type Library\Core\RestServer
 *
 */
class RestServer {


	/**
	 * Nom du service utilisé
	 * @var string
	 */
	private $service;
	/**
	 * Nom de la méthode HTTP employée
	 * @var string
	 */
	private $httpMethod;
	/**
	 * Nom de la méthode du service utilisée
	 * @var string
	 */
	private $classMethod;
	/**
	 * Liste des paramètres requis
	 * @var array
	 */
	private $requestParam;
	/**
	 * Nom de l'agent client (navigateur) qui envoie la requête au serveur REST
	 * @example 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0'
	 * @var string
	 */
	private $clientUserAgent;
	/**
	 * Liste des types de données acceptés par le client
	 * @example 'text/html,application/xhtml+xml,application/xml;q=0.9,*|*;q=0.8'
	 * @var string
	 */
	private $clientHttpAccept;
	/**
	 * Résultat renvoyé par le serveur REST
	 * @var object \stdClass
	 */
	private $json;

	private $sendMode;

	/**
	 * Tableau contenant le service, la methode et le type requis 
	 * @var array
	 */
	private $tabCorrespondance;

	private $modeStrict;

	/**
	 * 	Méthode __construct()
	 *
	 * 	Constructeur par défaut opérant le serveur REST
	 *
	 * 	@param
	 * 	@return 	void
	 *
	 */
	public function __construct(){

		
		ob_start();


		header("Content-type: application/json");

		$this->json = new \stdClass();
		$this->json->response = "";
		$this->json->apiError = false;
		$this->json->apiErrorMessage = "";
		$this->json->serverError = false;
		$this->json->serverErrorMessage = "";
		$this->json->page = "";		//supprimer header dans ce string
		$this->json->error=false;
		$this->sendMode='json';

		$this->httpMethod = strtoupper($_SERVER["REQUEST_METHOD"]);
		
		$this->modeStrict=false;
		
		$this->remplirCorrespondance();

		//$this->clientUserAgent = $_SERVER['HTTP_USER_AGENT'];
		//$this->clientHttpAccept = $_SERVER["HTTP_ACCEPT"];




		
		$D = array();

		switch ($this->httpMethod) {
			case 'GET'		: $D = $_GET; break;
			case 'POST'		: $D = $_POST; break;
			case 'PUT'		: parse_str(file_get_contents("php://input"), $D); break;
			case 'DELETE' 	: parse_str(file_get_contents("php://input"), $D); break;
			default 		: $this->showError("HTTP Method `".$this->httpMethod."` not found or allowed");
		}

		



		if(isset($D["service"])){
			
			$str = $D["service"];
			
			$this->service = "/Application/Controllers/".$str;
			
			$str = APP_ROOT."Controllers/".$str.".php";

			
			
			if(file_exists($str) ) {


				$this->service= str_replace('/', '\\', $this->service );;

				$strService=$this->service;

				$this->service = new $this->service();	//contient le controleur concerné. exemple :Recette

			}
			else {
				$this->showError("Service ".$D["service"]." not found.");
			}

			
			//$this->classMethod = strtolower($D["method"]);	//string de la methode de la classe. exemple: getrecettes
			$this->classMethod = $D["method"];	//string de la methode de la classe. exemple: getRecettes
			


			if(!method_exists($this->service, $this->classMethod)){
				$this->showError("Class method " . $strService . "::". $this->classMethod . " not found");
			}



			//on verifie si la method (GET POST PUT DELETE) correspond à l'action demandée
			//$this->httpMethod;
			//$this->classMethod
			//$strService
			str_replace('\Application\Controllers\\', '', $strService);
			
			if($this->modeStrict && $this->getCorrespondance(str_replace('\Application\Controllers\\', '', $strService), $this->classMethod ) !== $this->httpMethod ){
				$this->showError("Class method " . $strService . "::". $this->classMethod . " requiert un ".$this->getCorrespondance(str_replace('\Application\Controllers\\', '', $strService), $this->classMethod ) );
			}

			unset($D["service"]);
			$this->requestParam = $D; 

			

		}else{
			$this->showError("Param service not found");
		}
	}
	
	/**
	 * 	Méthode showError($message)
	 *
	 * 	Affiche les messages d'erreur du serveur
	 *
	 * 	@param 		string 		$message 		[Messages d'erreurs du serveur]
	 * 	@return 	void
	 *
	 */
	private function showError($message) {
		$this->json->serverError = true;
		$this->json->serverErrorMessage = $message;
		exit;
	}

	/**
	 * 	Méthode handle()
	 *
	 * 	Met en forme le résultat renvoyé par l'API
	 *
	 * 	@param
	 * 	@return 	void
	 *
	 */
	public function handle(){
		
		$result = call_user_func(array($this->service, $this->classMethod), $this->requestParam);
		$this->json->response 			= $result->response;
		$this->json->apiError 			= $result->apiError;
		$this->json->apiErrorMessage 	= $result->apiErrorMessage;
		$this->sendMode					= $result->sendMode;
		//exit;
	}

	/**
	 * 	Méthode __destruct()
	 *
	 * 	Destructeur par défaut
	 *
	 * 	@param
	 * 	@return 	void
	 *
	 */
	public function __destruct(){	//envoi
		
		if($this->json->apiError || $this->json->serverError){
			$this->json->error=true;
		}else{
			$this->json->error=false;
		}

		//header_remove();
		$header_size =0;		// curl_getinfo(curl_init(), CURLINFO_HEADER_SIZE);
		$body = substr(ob_get_contents(), $header_size);

		$this->json->page="
		<div
			style='background-color:black;
			color:green;
			width:800px;
			height:600px;
			overflow:auto;
			'>
				@@@>>><br />
			<strong>web service (:(|)</strong>

			".$body."<br>
			<<<@@@<br /><br />
			by Samyn, Na&iuml;la
		</div>";

		ob_clean();


		if($this->sendMode==='json'){
			echo json_encode($this->json, JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);
		}elseif ($this->sendMode==='brut') {
			header("Content-type: text/html");
			echo $body;
		}elseif ($this->sendMode==='brut+') {
			header("Content-type: text/html");
			echo $body;
			//var_export($this->json);
		}
	}


	public function convEnTab($obj){
		$model  = new \Library\Model\Model('localhost');
        return $model->convEnTab($obj);
	}	


	public function remplirCorrespondance(){
		$tab=array();

		$tab['ViewRecette'] = array(
			//'service'				=> 'method', 	easter egg
			'getViewRecette'				=> 'GET',
			'getAllWiewRecettes'			=> 'GET'
		);
		$tab['ViewPanier'] = array(
			'getViewPanier'					=> 'GET'
		);
		$tab['ViewProduit'] = array(
			'getAllViewProduits'			=> 'GET',
			'getViewProduit'				=> 'GET'
		);

		$tab['ViewListProduits'] = array(
			'getViewListProduitsByProduit' => 'GET',
			'getViewListProduitsByRecette' => 'GET'
		);
		$tab['ViewListIngredients'] = array(
			'getViewListIngredients' => 'GET'
		);

		$tab['ViewCommentaire'] = array(
			'getViewCommentaire' => 'GET'
		);
		$tab['ViewCategorie'] = array(
			'getViewCategorie' => 'GET'
		);
		$tab['User'] = array(
			'authentification'				=> 'GET',
			'getUser'						=> 'GET',
			'redefinirPassword'				=> 'POST',
			'insertUser'					=> 'POST',
			'updateUser'					=> 'PUT',
			'deleteUser'					=> 'DELETE'
		);
		$tab['Unite'] = array(
			'getUnites' 	=> 'GET',
			'insertUnites' 	=> 'POST',
			'updateUnite' 	=> 'PUT',
			'deleteUnite' 	=> 'DELETE',
		);
		$tab['Recherche'] = array(
			'getAutoCompletion' 	=> 'GET',
			'getRecherche'		 	=> 'GET'
		);

		$tab['Recette'] = array(
			'getRecettes' 	=> 'GET',
			'insertRecette' 	=> 'POST',
			'updateRecette' 	=> 'PUT',
			'deleteRecette' 	=> 'DELETE',
		);

		$tab['QuestionSecrete'] = array(
			'getQuestionSecretes' 		=> 'GET',
			'getQuestionSecrete' 		=> 'POST',
			'insertQuestionSecrete' 	=> 'POST',
			'updateQuestionSecrete' 	=> 'PUT',
			'deleteQuestionSecrete'		=> 'DELETE'
		);
		$tab['Produit'] = array(
			'getAllProduits' 	=> 'GET',
			'getProduit' 	=> 'GET',
			'insertProduit' 	=> 'POST',
			'updateProduit' 	=> 'PUT',
			'deleteProduit'	=> 'DELETE',
			'recupererScriptNewProduit'	=> 'GET',
			'getImageProduit'	=> 'GET',
			'envoiImageProduit'	=> 'GET'
		);
		$tab['Panier'] = array(
			'getPanier' 	=> 'GET',
			'insertPanier' 	=> 'POST',
			'updatePanier' 	=> 'PUT',
			'deletePanier' 	=> 'DELETE',
			'viderPanier'	=> 'DELETE',
			'getHtmlIconPanier'	=> 'GET',
			'existeDansPanier'	=> 'GET',
			'getSommePanier'	=> 'GET'
		);



		$tab['Note'] = array(
			'updateNote' 	=> 'PUT',
			'getNote' 	=> 'GET',
			'getMoyenneNote' 	=> 'GET'
		);



		$tab['Mail'] = array(
			'envoyerMail' 	=> 'GET',
			'testMail' 	=> 'GET',
			'redefinirPassword' 	=> 'PUT'
		);



		$tab['ListIngredients'] = array(
			'insertListIngredients' 	=> 'POST',
			'updateListIngredients' 	=> 'PUT'
		);



		$tab['Ingredient'] = array(
			'getIngredients' 	=> 'GET',
			'insertIngredients' 	=> 'POST',
			'updateIngredient' 	=> 'PUT',
			'deleteIngredient' 	=> 'DELETE'
		);


		$tab['Commentaire'] = array(
			'getCommentaires' 	=> 'GET',
			'getCommentaire' 	=> 'GET',
			'insertCommentaire' 	=> 'POST',
			'updateCommentaire' 	=> 'PUT',
			'deleteCommentaire' 	=> 'DELETE'
		);


		$tab['Categorie'] = array(
			'getCategories' 	=> 'GET',
			'insertCategorie' 	=> 'POST',
			'updateCategorie' 	=> 'PUT',
			'deleteCategorie' 	=> 'DELETE',
			'getImageCategorie' 	=> 'GET',
			'envoiImageCategorie' 	=> 'PUT'
		);



		//var_dump($tab);

		$this->tabCorrespondance= $tab;
		return true;
	}



	public function getCorrespondance( $service, $method ){
		//echo "<br>".$service."###<br>". $method."###<br>";

		if ( array_key_exists( $service, $this->tabCorrespondance )  ) {
			if ( array_key_exists( $method, $this->tabCorrespondance[$service] )  ) {
				return $this->tabCorrespondance[$service][$method];
			}else return "rien";
		}else return "rien";
		
		
		
	}

}
