"use strict";


for(let i =0;i < document.getElementById('listeAnimal').getElementsByTagName("li").length-1 ;i++){
    document.getElementById(i).addEventListener('click', (event) =>{
        if(document.getElementById(i).textContent == 'DETAIL'){
            document.getElementById(i).textContent = 'CACHER'; 
        }
        else{
            document.getElementById(i).textContent = 'DETAIL';
        }
        let id = event.currentTarget.value;
        console.log(id);
        
        console.log("".concat('site.php?action=json&id=', id));
        let xhr = new XMLHttpRequest;
        xhr.open('GET', "".concat('site.php?action=json&id=', id));
        xhr.responseType = 'json';
        xhr.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    // La requête a abouti
                    var jsonData = this.response;
                    console.log(jsonData);
                } else {
                    // La requête a échoué
                    console.error("Échec de la requête avec le statut: " + this.status);
                }
            }
        };
        
        xhr.addEventListener('load', afficherDetail);
        xhr.send();
    })
}


function afficherDetail(event){
    let xhr = event.currentTarget;

    for(let i =0;i < document.getElementById('listeAnimal').getElementsByTagName("li").length-1 ;i++){
        let ul = document.getElementById("".concat('div',i));
        if(document.getElementById(i).textContent == 'CACHER'){
            let li1 = document.createElement("li");
            let li2 = document.createElement("li");
            li1.textContent = "Age : "+xhr.response['age'];
            li2.textContent = "Espece : "+xhr.response['espece'];
            ul.appendChild(li1);
            ul.appendChild(li2);
        }
        else{
            ul.textContent = " ";
        }
    }
}
    
    



