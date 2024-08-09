<?php


require_once("model/AnimalStorageStub.php");
require_once("model/Animal.php");
class JsonView {
    
    private $storage;
    private $storageJson;
    public function __construct(AnimalStorage $sto) {
        $this->storage = $sto->readAll();
    }

    
    public function getDetail($nom){
        foreach($this->storage as $animal){
            if($animal->getNom() === $nom){
                $detail = array('nom' => $animal->getNom(), 'age' => $animal->getAge(),'espece' => $animal->getEspece() );
                $detailJson = json_encode($detail);
            }
        }
        echo($detailJson);
    }
}

?>