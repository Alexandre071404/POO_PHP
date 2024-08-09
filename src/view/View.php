<?php
require_once("Router.php");
require_once("model/Animal.php");
class View {
    private $title;
    private $content;
    private $detail;
    private $router;
    private $menu;
    private $feedback;

    public function __construct(Router $router,$feedback) {
        $this->router = $router;
        $this->feedback = $feedback;
        $this->menu = "<ul style='list-style:none'>
        <li><a style='text-decoration:none;font-size:25px;' href='site.php'>⌂ Accueil</a></li>
        <li><a style='text-decoration:none;font-size:25px;' href='site.php?liste'>☰ Liste</a></li>
       	<li><a style='text-decoration:none;font-size:25px;' href='".$this->router->getAnimalCreationURL()."'>➕ Ajouter un animal</a></li>
        <li><a style='text-decoration:none;font-size:25px;' href='site.php?author'>❓À Propos</a></li></ul>";
    }
    public function render(){
    
        echo '<!DOCTYPE html>
        <html lang="fr">
        <head>

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>'.$this->title.'</title>
            <style>
			*,::before,::after{
			    margin:0;
			    padding:0;
			    }
			nav{
			    background-color:black ;
			    }
			nav li{
			    display:inline-block;
			    text-align:center;
			    width:24%;
			    }
			nav a{
			    padding:20px;
			    display:block;
			    color:white;
			    transition:0.7s;}

			
			.contenu a:not(.buta){
			    color:black; 
			    transition:0.7s;}    
			.contenu a:not(.buta):hover{
				color:gold;
				background-color:black ;}
			#retour:hover{
				    color:white;
				    background-color:black;}


			.butajout{    
			    background-color:black;
			    color:white;
			    border-radius:20px;
			    transition:0.7s;
			}
			.butajout:hover{
				cursor:pointer;
				color:black;
				background-color:white;
			    }
			    
			nav a:hover{
				color:gold; 
				}

			.buta{    
			    background-color:black;
			    color:white;
			    border-radius:20px;
			    transition:0.7s;
				}
			.buta:hover{    
			    background-color:white;
			    color:black;
			   
				        }
            #supp{    
			    background-color:black;
			    color:white;
                transition:0.7s;
				        }
                        
            #supp:hover{    
                background-color:red;
                color:white;
            }
            #modif{    
                transition:0.7s;
				        }
                        
            #modif:hover{    
                background-color:orange;
                color:white;
            }
            .butsuppr{    
			    background-color:white;
			    color:black;
			    transition:0.7s;
				}
            .butsuppr:hover{   
                cursor:pointer; 
                background-color:red;
                color:white;
                    }
            #retoursup{
				color:white;
				background-color:red;}
            #retoursup:hover{
				    color:red;
				    background-color:black;}
                
        
        	</style>
        </head>
        

        <body>
        <script defer src="view/DetailView.js"></script>
            <nav>'.$this->menu.'</nav>
            <span style="display:block;width:100vw;text-align:center;background-color:red;font-size:20px;color:white;">'.$this->feedback.'</span>
            <h1 style="text-align:center;margin-top:30px;padding-bottom:15px;border-bottom:1px solid black;margin-bottom:20px;">'.$this->title.'</h1>
            <div class="contenu" style="margin-bottom:55px;text-align:center;">'.$this->content.'</div>
            <footer style="background-color:black;color:white;position:fixed;bottom:0;width:100vw;padding:10px"><p style="text-align:center">2023-L3 | Transon Alexandre Mandin Paul </p></footer>
        </body>
        </html>';

        
    }
    public function prepareTestPage(){
        $this->title = "Test Titre";
        $this->content="Un contenu vraiment simple";
        
    }
    public function prepareAnimalPage(Animal $animal){
        $id=trim($_GET['id']);
        $this->title="Page sur ".$animal->getNom();
        $this->content=$animal->getNom()." est un animal de l'espèce ".$animal->getESpece()." et son âge est de ".$animal->getAge()." an";
        if(intval($animal->getAge())>=2)//on vérifie l'age afin de savoir si on doit mettre un s ou pas 
            $this->content.="s";
            
        $this->content.="<ul><li style=' text-align:center; list-style:none; margin-top:30px; '><a id='modif' style='width:15vw; display:inline-block; margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='site.php?action=modifier&idm=".$id."'>✏️ Modifier</a>
        <a id='supp' style='width:15vw;display:inline-block;margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='site.php?action=supprimer&ids=".$id."'>❌ Supprimer</a></li></ul>";
        $this->content.="<ul><li style=' text-align:center;list-style:none;margin-top:30px; '><a id='retour' style='width:20vw;display:block;margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='site.php?liste'>🔙 Retour</a></li></ul>";
    }
    public function prepareUnknownAnimalPage(){
        $this->title="Animal inconnu";
        $this->content="<p>Cette animal n'est pas dans notre liste.</p>";
        $this->content.="<p style='margin-top:30px'>Vous pouvez en ajouter un nouveau si vous le souhaitez</p>";
        $this->content.="<ul><li style='text-align:center;list-style:none;margin-top:10px;'><a id='retour' style='width:20vw;display:block;margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='site.php?action=nouveau'>➕ Ajouter un animal</a></li></ul>";

    }
    public function prepareAccueilPage(){
        $this->title="Bienvenue sur notre site";
        $this->content="Notre site regroupe une base de donnée d'animaux avec leur nom leur espèce et leur âge. <br><br><br><br><br><br> Que souhaitez-vous faire?";
        $this->content.="<ul><li style='text-align:center;list-style:none;margin-top:20px;'><a class='buta' style='width:30vw;display:block;margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='site.php?liste'>Consulter la liste des animaux ▸</a></li>";
        $this->content.="<li style='text-align:center;list-style:none;margin-top:20px;'><a class='buta' style='width:30vw;display:block;margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='".$this->router->getAnimalCreationURL()."'>Ajouter un animal dans la liste ▸</a></li>";
        $this->content.="<li style='text-align:center;list-style:none;margin-top:20px;'><a class='buta' style='width:30vw;display:block;margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='site.php?author'>Consulter les informations concernant le site ▸</a></li></ul>";

    }
    
    
    public function prepareAnimalCreationPage(AnimalBuilder $ab){

        if(empty($ab->getdata())){
            $this->title="Formulaire d'ajout d'animal";
            $this->content=" <form action='".$this->router->getAnimalSaveURL()."' method='post' style='margin-top:15px;'>
            <label>Nom de l'animal : <input type='text' name='name' placeholder='Simba'></label><br><br>
            <label>Espèce de l'animal : <input type='text' name='espece' placeholder='Lion'></label><br><br>
            <label>Âge de l'animal : <input type='text' name='age' placeholder='18'></label><br><br>
            <span style='color:red;'>".$ab->geterror()."</span><br>
            <input class='butajout' style='margin-top:10px;padding:20px;margin-bottom:40px;' type='submit' name='envoie' value='Ajouter un animal'>
            </form>";
        }

        else{
            if(!empty($ab->getAGE_REF())&&intval($ab->getAGE_REF())<0){
                $error="L'âge ".$ab->getAGE_REF()." que vous avez donné est invalide veuillez entrer un âge correct.";
                $this->title="Formulaire d'ajout d'animal";
                $this->content=" <form action='".$this->router->getAnimalSaveURL()."' method='post' style='margin-top:15px;'>
                <label>Nom de l'animal : <input type='text' name='name' value='".$ab->getNAME_REF()."' placeholder='Simba'></label><br><br>
                <label>Espèce de l'animal : <input type='text' name='espece' value='".$ab->getSPICIES_REF()."' placeholder='Lion'></label><br><br>
                <label>Âge de l'animal : <input type='text' name='age' placeholder='18'></label><br><br>
                <span style='color:red;'>".$ab->geterror()."</span><br>
                <input class='butajout' style='margin-top:10px;padding:20px;margin-bottom:40px;' type='submit' name='envoie' value='Ajouter un animal'>
                
                </form>";

            $this->content.="<ul style='text-align:center;list-style:none'><li><a id='retour' style='border-radius:20px;width:20vw;display:block;margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='site.php'>🔙 Retour</a></li></ul>";
            }
            else{   
                    $this->title="Formulaire d'ajout d'animal";
                    $this->content=" <form action='".$this->router->getAnimalSaveURL()."' method='post' style='margin-top:15px;'>
                    <label>Nom de l'animal : <input type='text' name='name' value='".$ab->getNAME_REF()."' placeholder='Simba'></label><br><br>
                    <label>Espèce de l'animal : <input type='text' name='espece' value='".$ab->getSPICIES_REF()."' placeholder='Lion'></label><br><br>
                    <label>Âge de l'animal : <input type='text' name='age' value='".$ab->getAGE_REF()."' placeholder='18'></label><br><br>
                    <span style='color:red;'>".$ab->geterror()."</span><br>
                    <input class='butajout' style='margin-top:10px;padding:20px;margin-bottom:40px;' type='submit' name='envoie' value='Ajouter un animal'>
                    </form>";
                    $this->content.="<ul style='text-align:center;list-style:none'><li><a id='retour' style='border-radius:20px;width:20vw;display:block;margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='site.php'>🔙 Retour</a></li></ul>";                
                }
        }
    } 
    public function prepareAnimalModif(AnimalBuilder $ab){
        $id=trim($_GET['idm']);
        if(empty($ab->getdata())){
            $this->title="Formulaire de modification d'animal";
            $this->content=" <form action='".$this->router->getAnimalmodifURL()."&idm=".$id."' method='post' style='margin-top:15px;'>
            <label>Nom de l'animal : <input type='text' name='name' placeholder='Simba'></label><br><br>
            <label>Espèce de l'animal : <input type='text' name='espece' placeholder='Lion'></label><br><br>
            <label>Âge de l'animal : <input type='text' name='age' placeholder='18'></label><br><br>
            <span style='color:red;'>".$ab->geterror()."</span><br>
            <input class='butajout' style='margin-top:10px;padding:20px;margin-bottom:40px;' type='submit' name='envoie' value='Confirmer les modifications'>
            </form>";
            $this->content.="<ul style='text-align:center;list-style:none'><li><a id='retour' style='border-radius:20px;width:20vw;display:block;margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='site.php?id=".$id."'>🔙  Annuler les modifications</a></li></ul>";
        }

        else{
            if(!empty($ab->getAGE_REF())&&intval($ab->getAGE_REF())<0){
                $error="L'âge ".$ab->getAGE_REF()." que vous avez donné est invalide veuillez entrer un âge correct.";
                $this->title="Formulaire de modification d'animal";
                $this->content=" <form action='".$this->router->getAnimalmodifURL()."&idm=".$id."' method='post' style='margin-top:15px;'>
                <label>Nom de l'animal : <input type='text' name='name' value='".$ab->getNAME_REF()."' placeholder='Simba'></label><br><br>
                <label>Espèce de l'animal : <input type='text' name='espece' value='".$ab->getSPICIES_REF()."' placeholder='Lion'></label><br><br>
                <label>Âge de l'animal : <input type='text' name='age' placeholder='18'></label><br><br>
                <span style='color:red;'>".$ab->geterror()."</span><br>
                <input class='butajout' style='margin-top:10px;padding:20px;margin-bottom:40px;' type='submit' name='envoie' value='Confirmer les modifications'>
                
                </form>";

            $this->content.="<ul style='text-align:center;list-style:none'><li><a id='retour' style='border-radius:20px;width:20vw;display:block;margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='site.php?id=".$id."'>🔙  Annuler les modifications</a></li></ul>";
            }
            else{   
                    $this->title="Formulaire de modification d'animal";
                    $this->content=" <form action='".$this->router->getAnimalmodifURL()."&idm=".$id."' method='post' style='margin-top:15px;'>
                    <label>Nom de l'animal : <input type='text' name='name' value='".$ab->getNAME_REF()."' placeholder='Simba'></label><br><br>
                    <label>Espèce de l'animal : <input type='text' name='espece' value='".$ab->getSPICIES_REF()."' placeholder='Lion'></label><br><br>
                    <label>Âge de l'animal : <input type='text' name='age' value='".$ab->getAGE_REF()."' placeholder='18'></label><br><br>
                    <span style='color:red;'>".$ab->geterror()."</span><br>
                    <input class='butajout' style='margin-top:10px;padding:20px;margin-bottom:40px;' type='submit' name='envoie' value='Confirmer les modifications'>
                    </form>";
                    $this->content.="<ul style='text-align:center;list-style:none'><li><a id='retour' style='border-radius:20px;width:20vw;display:block;margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='site.php?id=".$id."'>🔙  Annuler les modifications</a></li></ul>";                
                }
        }
    } 



    public function prepareAnimalSuppr(Animal $a){
        $id=trim($_GET['ids']);
        $this->title="Formulaire de suppression de ".$a->getNom();
        $this->content=" <form action='".$this->router->getAnimalsupprURL()."&ids=".$id."' method='post' style='margin-top:15px;'>
                    <label>".$a->getNom()." de l'espèce ".$a->getESpece()." agé de ".$a->getAge()." an";
                    if(intval($a->getAge())>=2)//on vérifie l'age afin de savoir si on doit mettre un s ou pas 
                        $this->content.="s ";
                    $this->content.="est sur le point d'être supprimé souhaitez vous confirmer sa suppression ? </label><br><br>
                    <input class='butsuppr' style='margin-top:10px;padding:20px;margin-bottom:20px;' type='submit' name='envoie' value='❌ Confirmer la suppression'>
                    </form>";
                    $this->content.="<ul style='text-align:center;list-style:none'><li><a id='retoursup' style='width:20vw;display:block;margin:auto auto;padding:15px;text-decoration:none;border:1px solid black;' href='site.php?id=".$id."'>Annuler la suppression de ".$a->getNom()."</a></li></ul>";                

    } 

    public function prepareAuthor(){
        $this->title="Auteurs";
        $this->content=" Site réalisé dans le cadre de la matière Application Web avancée en L3 informatique par:<br><ul><li style='list-style:none;'><strong>Mandin Paul</strong></li> <li style='list-style:none;margin-bottom:15px;'><strong>Transon Alexandre</strong></li>";
        $this->content.="<li style='text-align:center;list-style:none'><a class='buta' style='width:20vw;display:block;margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='site.php'>🔙 Retour</a></li></ul>";

    } 
    public function prepareListPage(array $animalsTab){
        $this->title="Liste des animaux";
        if(count($animalsTab)<1){
            $this->content="<p style='margin-bottom:30px;'>Nous n'avons aucun animal de stocké vous pouvez en revanche commencer à en ajouter à la liste.<p>";       
            $this->content.="<ul><li style='text-align:center;list-style:none;margin-bottom:20px'><a id='retour' style='width:20vw;display:block;margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='site.php?action=nouveau'>➕ En cliquant juste ici</a></li>";
        }
        else {
            $this->content="<ul id = listeAnimal style='text-align:center;list-style:none'>";
            $i =0;
            foreach($animalsTab as $animal=>$valeur){ 
                $this->content.="<li><a style='width:20vw;display:block;margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='".$this->router->getAnimalURl($animal)."'>🐾 ".$valeur->getNom()."</a> <button id = ".$i." value = ".$animal.">".'DETAIL'."</button></li> <li id = div".$i."> </li>";
                $i++;
            }
            
    }
        $this->content.="<li style='text-align:center;list-style:none'><a class='retour' style='width:20vw;display:block;margin:auto auto;padding:10px;text-decoration:none;border:1px solid black;' href='site.php'>🔙 Retour</a></li></ul>";


    } 
    public function displayAnimalCreation($id){
       $url=$this->router->getAnimalURl($id);
       $this->router->POSTredirect($url,"Votre animal à bien été créé.");
    }
    public function displayAnimalmodif($id){
        $url=$this->router->getAnimalURl($id);
        $this->router->POSTredirect($url,"Votre animal à bien été modifié.");
     }  
     public function displayAnimalsupp(){
        $url="site.php";
        $this->router->POSTredirect($url,"Votre animal à bien été supprimé.");
     }  

}
?>
