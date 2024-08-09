<?php

class Animal{
    private $nom;
    private $espece;
    private $age;

    public function __construct($n,$e,$a){
        $this->nom = $n;
        $this->espece = $e;
        $this->age = $a;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getESpece(){
        return $this->espece;
    }
    public function getAge(){
        return $this->age;
    }
    
}

?>