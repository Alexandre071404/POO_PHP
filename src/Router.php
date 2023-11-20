<?php
require_once("control/Controller.php");
require_once("view/View.php");
require_once("model/Animal.php");

class Router{

	public function main() {

		try {
			if (key_exists('id', $_GET)) {
				$view = new View($this);
				$control=new Controller($view);
				$control->showInformation($_GET['id']);
				$view->render();
			} 
			else if (key_exists('liste', $_GET)) {
				$view = new View($this);
				$control=new Controller($view);
				$control->showList();
				$view->render();
			} 
			else {
				$view = new View($this);
				$control=new Controller($view);
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
}
?>
