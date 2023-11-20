<?php

require_once("model/Animal.php");
require_once("model/AnimalStorage.php");


class Controller{    
    
    protected $view;
    protected $animalsTab;
    public function __construct(View $v,AnimalStorage $tabanimalStorage) {
        $this->view = $v;
        $this->animalsTab = $tabanimalStorage;
    }

    public function showInformation($id) {
        if (array_key_exists($id,$this->animalsTab->readAll())){
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
    }

?>
