let bouton = document.getElementById("iconeSpr");
bouton.addEventListener("click", supprimer);

const params = new URLSearchParams(window.location.search);
const idRecette = params.get('idRecette');


function supprimer(){
    var confirmation = confirm("Voulez-vous supprimer cette recette?");
    if (confirmation) {
        supprimerRecette();
    } else {
    }
}

function supprimerRecette(){
    let requeteHTTP = new XMLHttpRequest();

    requeteHTTP.open("GET", "index.php?action=supprimerRecette&idRecette=" + idRecette, true);
    requeteHTTP.send();
    
    requeteHTTP.onload = function(){
        if(requeteHTTP.status === 200){
            document.location.href = ".?action=listeRecettes";
            return;
        }
        console.error("Erreur pendant la supression !");
    }
}