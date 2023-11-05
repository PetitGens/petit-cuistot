<?php
// L'index.php joue le rôle de routeur. 
// C'est lui qui redirige l'utilisateur vers les différentes pages en analysant l'URL.
// Ici, on choisit la page en fonction d'une valeur dans le $_GET.
// (on peut pas trop faire autrement sans toucher au serveur Apache...)

// Le retour se chargera aussi de gérer les exceptions avec un try / catch

require_once 'src/controllers/accueil.php';
require_once 'src/controllers/pageRecette.php';
require_once 'src/controllers/pageConnexion.php';
require_once 'src/controllers/connexion.php';

try{
    session_start();

    // Si 'action' n'est pas défini, on charge la page d'accueil
    if(! isset($_GET['action']) || empty($_GET['action'])){
        pageAccueil(3);
        return;
    }

    // On teste les différentes valeurs possible de 'action'
    // Si ça ne correspond à aucune page, on renvoie vers la page d'erreur
    // (pour l'instant on a pas d'autre page, donc on retourne forcément une erreur)
    switch($_GET['action']){
        case 'test':
            require 'test/tests.php';
            break;

        case 'pageConnexion':
            $controleur = new PageConnexionControleur();
            $controleur->executer();
            break;

        case 'erreurConnexion':
            $controleur = new PageConnexionControleur(true);
            $controleur->executer();
            break;

        case 'connexion':
            $controleur = new ConnexionController();
            $controleur->executer();
            break;

        case 'detail-recette':
            $controleur = new PageRecetteControleur();
            $controleur->executer();
            break;
            
        default:
            throw new Exception("la page demandée n'a pas été trouvée");
    }
}
catch(Exception $e){
    $messageErreur = $e->getMessage();
    require 'templates/erreur.php';
}