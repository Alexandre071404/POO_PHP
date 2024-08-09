<?php
require_once("control/Controller.php");
require_once("view/View.php");

require_once("model/Animal.php");
require_once("model/AnimalStorageStub.php");	
class Router{
	private AnimalStorage $sto;

	public function main(AnimalStorage $sto){
		$feedback="";
		if(isset($_SESSION["feedback"])){
			$feedback=$_SESSION["feedback"];
			$_SESSION["feedback"]="";
		} 
		$v = "view";
		$this->sto = $sto;
		try {
			if (key_exists('author', $_GET)) {
				
				$control=new Controller($v,$this->sto,$this, $feedback);
				$view = $control->showRender($v,$this, $feedback);
				$control->ShowAuthor();
				$view->render();
			} 
			else if (key_exists('liste', $_GET)) {
				$control=new Controller($v,$this->sto,$this, $feedback);
				$view = $control->showRender($v,$this, $feedback);
				$control->showList();
				$view->render();
			}
			else if (key_exists('action', $_GET)) {
				
			
				$control=new Controller($v,$this->sto,$this, $feedback);
				$view = $control->showRender($v,$this, $feedback);
				$action = trim($_GET['action']);
				switch ($action) {
	

					case "nouveau": 
						$data=array();
						$build=new AnimalBuilder($data);
						$control->ShowCreation($build);
						break;
					case "sauverNouveau":
						$control->saveNewAnimal($_POST);
						break;

					case "supprimer":
						$id = trim($_GET['ids']);
						$ani=$this->sto->read($id);
						$control->Showsupp($ani);

						break;
					case "confirmerSuppression":
						$id = trim($_GET['ids']);
						$control->suppAnimal($id);
						break;


					case "modifier":
						$id = trim($_GET['idm']);
						$ani=$this->sto->read($id);
						$data2=array('name'=>$ani->getNom(),'espece'=>$ani->getESpece(),'age'=>$ani->getAge());
						$build=new AnimalBuilder($data2);
						$control->Showmodif($build);
						break;
					case "sauverModification":
						$control->ModifAnimal($_POST,trim($_GET['idm']));
						break;
					case "json":
						$v = "json";
						$id = trim($_GET['id']);
						$control=new Controller($v,$this->sto,$this, $feedback);
						
						$view = $control->showRender($v,$this, $feedback);
						
						$control->showDetail(trim($_GET['id']));
						break;


					default:// Si aucune action n'est faite alors le site redirige l'utilisateur vers l'accueil du site 
					$control->AccueilPage();
					break;
				}
				if($v === "view"){
					$view->render();
				}

			}
			else if (key_exists('id', $_GET)) {
					$control=new Controller($v,$this->sto,$this, $feedback);
					$view = $control->showRender($v,$this, $feedback);
					$control->showInformation($_GET['id']);
					$view->render();
				} 	
				
			
			else {
				$control=new Controller($v,$this->sto,$this, $feedback);
				$view = $control->showRender($v,$this, $feedback);
				$control->AccueilPage();
				$view->render();
				
			}

		}catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	public function getAnimalURl($id){
		return "site.php?id=".$id."";
	}
	public function getAnimalCreationURL(){
		return "site.php?action=nouveau";
	}
	public function getAnimalSaveURL(){
		return "site.php?action=sauverNouveau";
	}
	public function getAnimalmodifURL(){
		return "site.php?action=sauverModification";
	}
	public function getAnimalsupprURL(){
		return "site.php?action=confirmerSuppression";
	}
	public function POSTredirect($url,$feedback){
		$_SESSION["feedback"]=$feedback;
		header('HTTP 303 See Other');
		header('Location: '.$url);
		die;
	}
	public function getAnimalURlJSON($id){
		return "site.php?action=json";
	}
}
?>
