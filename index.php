<?php
// L'index.php joue le rôle de routeur. 
// C'est lui qui redirige l'utilisateur vers les différentes pages en analysant l'URL.
// Ici, on choisit la page en fonction d'une valeur dans le $_GET.
// (on peut pas trop faire autrement sans toucher au serveur Apache...)

// Le retour se chargera aussi de gérer les exceptions avec un try / catch

require_once 'src/controllers/controleur.php';
require_once 'src/controllers/listeRecettes.php';
require_once 'src/controllers/accueil.php';

try{
    // Si 'action' n'est pas défini, on charge la page d'accueil
    if(! isset($_GET['action']) || empty($_GET['action'])){
        $accueil = new AccueilControleur();
        $accueil->executer();
        return;
    }

    // On teste les différentes valeurs possible de 'action'
    // Si ça ne correspond à aucune page, on renvoie vers la page d'erreur
    // (pour l'instant on a pas d'autre page, donc on retourne forcément une erreur)
    switch($_GET['action']){
        case 'listeRecettes':
            $controller = new ListeRecettesControleur;
            $controller->executer();
            break;

        case 'test':
            require 'test/tests.php';
            break;

        default:
            throw new Exception("la page demandée n'a pas été trouvée");
    }
}
catch(Exception $e){
    $messageErreur = $e->getMessage();
    require 'templates/erreur.php';
} 