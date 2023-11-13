<?php
require_once("control/Controller.php");
require_once("view/View.php");

class Router{

	public function main() {
		$view = new View();
		$control=new Controller($view);
		$control->showInformation("felix");
		$view->render();
		

	}
}
?>
