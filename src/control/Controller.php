<?php

require_once("model/Animal.php");

class Controller{    
    
    protected $view;
    protected $animalsTab;
    public function __construct(View $v) {
        $this->view = $v;
        $this->animalsTab=array(
            'medor' => new Animal('Médor','Chien','8'),
            'felix' =>  new Animal('Félix','Chat','3'),
            'denver' =>  new Animal('Denver','Dinausore','456778980'),
        );
    }

    public function showInformation($id) {
        if (array_key_exists($id,$this->animalsTab)){
            $this->view->prepareAnimalPage($this->animalsTab[$id]);
        } 
        else {
           $this->view->prepareUnknownAnimalPage();
        }
    }
    public function AccueilPage(){
            $this->view->prepareAccueilPage();
        }
        
    public function showList(){
            $this->view->prepareListPage($this->animalsTab);
        }
    }

?>