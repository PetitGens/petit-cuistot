// Éléments du DOM

let conteneurRecette = document.getElementById("conteneurRecette");
let divsRecettes = conteneurRecette.children;
let boutonPlus = document.getElementById("boutonPlus");


let nombreRecettesTotal = divsRecettes.length;
let nombresRecettesAffiches = 0;

afficherPlusRecettes();

boutonPlus.addEventListener("click", afficherPlusRecettes);

function afficherPlusRecettes(){
    if(nombresRecettesAffiches >= nombreRecettesTotal){
        return;
    }

    for(let i = nombresRecettesAffiches; i < nombresRecettesAffiches + 10; i++){
        divsRecettes[i].setAttribute("style", "display: block");
        if(nombresRecettesAffiches + i + 1 >= nombreRecettesTotal){
            boutonPlus.setAttribute("style", "display: none");
            return;
        }
    }

    nombresRecettesAffiches += 10;
}