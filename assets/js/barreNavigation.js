const menuFiltre = document.getElementById('menuFiltre');
const sousMenuFiltre = document.getElementById('sousMenuFiltre');

const menuCategorie = document.getElementById('menuCategorie');
const sousMenuCategorie = document.getElementById('sousMenuCategorie');

const menuCompte = document.getElementById('menuCompte');
const sousMenuCompte = document.getElementById('sousMenuCompte');

window.addEventListener('click', onClick);

/*menuFiltre.addEventListener('click', onMenuFiltre);
menuCategorie.addEventListener('click', onMenuCategorie);

if(menuCompte !== null){
    menuCompte.addEventListener('click', onMenuCompte);
}*/

function onClick(event){
    let target = event.target;
    if (target === menuFiltre || menuFiltre.contains(target)) {
        onMenuFiltre();
    } else if (target === menuCategorie || menuCategorie.contains(target)) {
        onMenuCategorie();
    } else if (menuCompte !== null && (target === menuCompte || menuCompte.contains(target))) {
        onMenuCompte();
    } else {
        sousMenuFiltre.classList.remove("show");
        sousMenuCategorie.classList.remove("show");
        cacherSousMenuCompte();
    }
}

function onMenuFiltre(){
    sousMenuFiltre.classList.toggle("show");

    sousMenuCategorie.classList.remove("show");
    cacherSousMenuCompte();
}

function onMenuCategorie(){
    sousMenuCategorie.classList.toggle("show");

    
    sousMenuFiltre.classList.remove("show");
    cacherSousMenuCompte();
}

function onMenuCompte(){
    sousMenuCompte.classList.toggle('show');

    sousMenuFiltre.classList.remove("show");
    sousMenuCategorie.classList.remove("show");
}

function cacherSousMenuCompte(){
    if(sousMenuCompte !== null){
        sousMenuCompte.classList.remove("show");
    }
}