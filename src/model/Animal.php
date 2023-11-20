<?php

class Animal{
    protected $nom;
    protected $espece;
    protected $age;

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