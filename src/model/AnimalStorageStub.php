<?php
class AnimalStorageStub implements AnimalStorage {
    private $animalsTab;
    public function __construct() {        
        $this->animalsTab=array(
            'medor' => new Animal('Médor','Chien','8'),
            'felix' =>  new Animal('Félix','Chat','3'),
            'denver' =>  new Animal('Denver','Dinausore','456778980'),
        );
    
    
    }
    public function read(String $id){
        return $this->animalsTab[$id];
    }
    public function readAll(){
        return $this->animalsTab;
    }
}

?>
