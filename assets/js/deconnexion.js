let boutonDeconnexion = document.getElementById("boutonDeconnexion");
boutonDeconnexion.addEventListener("click", resetSession);

function resetSession(){
    let requeteHTTP = new XMLHttpRequest();

    requeteHTTP.open("GET", "includes/resetSession.php", true);
    requeteHTTP.send();
    
    requeteHTTP.onload = function(){
        if(requeteHTTP.status === 200){
            console.log("Session supprimée.");
            document.location.href = ".";
            return;
        }
        
        console.error("Erreur pendant la réinitialisation !");
    };
}