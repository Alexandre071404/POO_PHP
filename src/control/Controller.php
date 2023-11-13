<?php
class Controller{    
    protected $animalsTab=array(
        'medor' => array('Médor', 'chien'),
        'felix' => array('Félix', 'chat'),
        'denver' => array('Denver', 'dinosaure'),
    );
    protected $view;
    public function __construct(View $v) {
        $this->view = $v;
    }

    public function showInformation($id) {
        if (array_key_exists($id,$this->animalsTab)){
            $this->view->prepareAnimalPage($this->animalsTab[$id][0], $this->animalsTab[$id][1]);
        } 
        else {
           $this->view->prepareUnknownAnimalPage();
        }
    }
    
    

}

?>