<?php


class View {
    protected $title;
    protected $content;
    public function render(){
    
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>'.$this->title.'</title>
        </head>
        <body>
            <h1>'.$this->title.'</h1>
            '.$this->content.'
        </body>
        </html>';
        
    }
    public function prepareTestPage(){
        $this->title = "Test Titre";
        $this->content="Un contenu vraiment simple";
        
    }
    public function prepareAnimalPage($name, $species){
        $this->title="Page sur ".$name;
        $this->content=$name." est un animal de l'espèce ".$species;
    }
    public function prepareUnknownAnimalPage(){
        $this->title="Animal inconnu";
        $this->content="Cette animal n'est pas dans la base de donnée";
    }
    public function prepareAccueilPage(){
        $this->title="Bienvenue sur notre site";
        $this->content="Veuillez compléter l'URL avec un id=";
    }
}
?>
