<?php
class AnimalStorageStub implements AnimalStorage {
    private $animalsTab;
    public function __construct() {        
        $this->animalsTab=array(
            'medor' => new Animal('Médor','Chien','8'),
            'nemo' =>  new Animal("Nemo",'poisson rouge','2'),
            'lucifer' =>  new Animal('Lucifer','Chat','6'),
            'calimero' =>  new Animal("Caliméro",'Poussin','1'),
            'felix' =>  new Animal('Félix','Chat','3'),
            'denver' =>  new Animal('Denver','Dinausore','456 778 980'),
            'boole' =>  new Animal('Boole','Chien','7'),
            'bambi' =>  new Animal('Bambi','Faon','17'),
            'abu' =>  new Animal('Abu','singe','8'),
            'mickey' =>  new Animal('Mickey','souris','95'),
            'malley' =>  new Animal("O'Malley",'chat','35'),
            'gedeon' =>  new Animal("Gédéon",'renard','40'),
            'doug' =>  new Animal("Doug",'chien','9'),

            






        );
    
    
    }
    public function read(String $id){
        return $this->animalsTab[$id];
    }
    public function readAll(){
        return $this->animalsTab;
    }
    public function create(Animal $a){
        //$this->animalsTab[$a->getNom()]=$a;
        new Exception;
    }
    public function update($id, Animal $b){
        //$this->animalsTab[$id]=$b;
        new Exception;
    }
    
    public function delete($id){
      // unset($this->animalsTab[$id]);
      new Exception;
    }
}

?>
