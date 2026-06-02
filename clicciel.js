function preparerRemplacementAuClic(){
    console.log("rentree preparerRemplacementPeriodique");


    var monImg=document.getElementById("mainImage"); /// récup le html 
    var boutonSuivant = document.getElementById("suivant"); /// récup le html 
    var boutonPrecedent = document.getElementById("precedent"); /// récup le html 
    
    var monTableau = [];
    var numeroCelluleTab = 0; /// place a l'image de a l'image de start 

    // récupérer les images depuis PHP
    fetch("getImages.php") /// appel de la base de donnée 
        .then(response => response.json())
        .then(data => {
            monTableau = data;

            // afficher la première image
            if(monTableau.length > 0){
            monImg.src = monTableau[0];
        }  /// sécurise au cas ou la table bdd est vide 
        }); 

	boutonSuivant.addEventListener("click", function(){
        console.log("ça AVANNCEEEEEE") /// message dans les fichier log pour vérifier sur la fonction marche 
        numeroCelluleTab++;  /// fait avancé les images 
        if(numeroCelluleTab >= monTableau.length){
            numeroCelluleTab = 0;
        }                                            /// un if qui permet de refaire venir a l'image de base si on depasse le nombre dimage 
        monImg.src = monTableau[numeroCelluleTab]; /// affiche l'image n+1 pour le click 
    });

    boutonPrecedent.addEventListener("click", function(){
        console.log("ça REEECCUULLLEEE")
        numeroCelluleTab--; /// fait reculé
        if(numeroCelluleTab < 0){     /// permet de vérif si on est avant la première image
            numeroCelluleTab = monTableau.length - 1; /// si on est supérieur a la première image alors on recule
        }
        monImg.src = monTableau[numeroCelluleTab];
    });
    
}


window.onload=function(){
    this.console.log("rentree onload");
    preparerRemplacementAuClic(); /// toute cet parti permet de "lancer" le code en appelelant la fonction et en éxécutant la page
}
