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
    } else if (target === menuCompte || menuCompte.contains(target)) {
        onMenuCompte();
    } else {
        sousMenuFiltre.classList.remove("show");
        sousMenuCategorie.classList.remove("show");
        sousMenuCompte.classList.remove("show");
    }
}

function onMenuFiltre(){
    sousMenuFiltre.classList.toggle("show");

    sousMenuCompte.classList.remove("show");
    sousMenuCategorie.classList.remove("show");
}

function onMenuCategorie(){
    sousMenuCategorie.classList.toggle("show");

    sousMenuCompte.classList.remove("show");
    sousMenuFiltre.classList.remove("show");
}

function onMenuCompte(){
    sousMenuCompte.classList.toggle('show');

    sousMenuFiltre.classList.remove("show");
    sousMenuCategorie.classList.remove("show");
}