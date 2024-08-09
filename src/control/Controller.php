<?php
require_once("model/Animal.php");
require_once("model/AnimalStorage.php");
require_once("model/AnimalBuilder.php");
require_once("view/View.php");
require_once 'view/JsonView.php';

class Controller{    
    
    private $view;
    private $animalsTab;
    public function __construct($v,AnimalStorage $tabanimalStorage,Router $rout, $feedback) {
        $this->animalsTab = $tabanimalStorage;
        $this->view = null;
    }

    public function showRender($v,Router $rout, $feedback){
        if($v ==="json"){
            $vu = new JsonView($this->animalsTab);
        }
        else if($v ==="view"){
            $vu = new View($rout, $feedback);
        }
        $this->view = $vu;
        return $vu;
        }   

    public function showDetail($id){
        if (key_exists($id,$this->animalsTab->readAll())){
            $this->view->getDetail($this->animalsTab->read($id)->getNom());
        } 
    }

    public function showInformation($id) {
        if (key_exists($id,$this->animalsTab->readAll())){
            $this->view->prepareAnimalPage($this->animalsTab->read($id));
        } 
        else {
           $this->view->prepareUnknownAnimalPage();
        }
    }
    
    public function AccueilPage(){
            $this->view->prepareAccueilPage();
        }
        
    public function showList(){
            $this->view->prepareListPage($this->animalsTab->readAll());
        }


    public function ShowAuthor(){
            $this->view->prepareAuthor();
        }
    


    public function ShowCreation($build){
        $this->view->prepareAnimalCreationPage($build);
    }
    public function Showsupp($ani){
        $this->view->prepareAnimalSuppr($ani);
    }

    public function Showmodif($build){
        $this->view->prepareAnimalModif($build);
    }
    public function saveNewAnimal(array $data){
        $build=new AnimalBuilder($data);
        $build->isValid();
        if($build->geterror()!=null) {
            $this->view->prepareAnimalCreationPage($build);

            }

        else{
            $animal=$build->createAnimal();
            $id=$this->animalsTab->create($animal);
            $this->view->displayAnimalCreation($id);
            //$this->view->prepareAnimalPage($animal);
            
        }
    }
    
    public function ModifAnimal(array $data,$id){
        $build=new AnimalBuilder($data);
        $build->isValid();
        if($build->geterror()!=null) {
            $this->view->prepareAnimalModif($build);

            }
        else{
            $animal=$build->createAnimal();
            $this->animalsTab->update($id,$animal);
            $this->view->displayAnimalmodif($id);
                
        }
    } 
    public function suppAnimal($id){
        $this->animalsTab->delete($id);
        $this->view->displayAnimalsupp($id);
    }   

    public function renderView($url){

    }  
}



?>
