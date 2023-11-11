
let but = document.getElementById("modifierEdito")


// Fonction pour récupérer le texte de la zone de texte
function recupEdito() {
    return document.getElementById("contenuEdito").value;
}

// Fonction pour enregistrer le contenu dans un fichier
function enregistrerContenu() {
    // Récupère le contenu
    var contenuEdito = recupEdito();

    
    // Le contenu que tu veux écrire dans le fichier
    const contenu = 'Bonjour, monde!';
    
    // Le chemin du fichier dans lequel tu veux écrire
    const cheminFichier = 'edito.txt';
    
    // Écriture dans le fichier
    fs.writeFile(cheminFichier, contenu, (erreur) => {
      if (erreur) {
        alert('Erreur lors de l\'écriture dans le fichier :', erreur);
      } else {
        alert('Le contenu a été écrit dans le fichier avec succès.');
      }
    });
}


but.addEventListener("click", enregistrerContenu())




