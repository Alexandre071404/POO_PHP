<?php
require_once("model/Animal.php");
require_once("model/AnimalStorage.php");
class AnimalBuilder{
    private $data;
    private $error;
    private $NAME_REF;
    private $SPICIES_REF;
    private $AGE_REF;
    function __construct ($data){
        $this->data=$data;
        if(!empty($data)){
            $this->NAME_REF=trim(htmlspecialchars($this->data['name']));
            $this->SPICIES_REF=trim(htmlspecialchars($this->data['espece']));
            $this->AGE_REF=trim(htmlspecialchars($this->data['age']));
         }
        

    }
    public function getdata(){
       return $this->data;
    }
    public function geterror(){
            return $this->error;
        }
    public function getNAME_REF(){
            return $this->NAME_REF;
         }
    public function getSPICIES_REF(){
            return $this->SPICIES_REF;
        }
    public function getAGE_REF(){
        return $this->AGE_REF;
    }

    public function setdata($a){
        $this->data=$a;
     }
    public function seterror($e){
        $this->error=$e;
     }

     /*
     Cette méthode renvoie des entiers afin de pouvoir identifier l'erreur exacte de la saisie
      */
    public function isValid(){
        if(empty($this->NAME_REF) || empty($this->SPICIES_REF) || empty($this->AGE_REF)||intval($this->AGE_REF)<0)
            $this->error="Un des champs de caractères n'a pas été remplie";
        else if(!ctype_digit($this->AGE_REF))
            $this->error="Votre âge n'est pas un entier";
        return $this->error;
    }

    public function createAnimal(){
        $this->NAME_REF=htmlspecialchars($this->NAME_REF);
        $this->dataSPICIES_REF=htmlspecialchars($this->SPICIES_REF);
        $this->AGE_REF=htmlspecialchars($this->AGE_REF);
        $animal=new Animal($this->NAME_REF,$this->SPICIES_REF,$this->AGE_REF);
        return $animal;
    }



}