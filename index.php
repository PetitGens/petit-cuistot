<?php
// L'index.php joue le rôle de routeur. 
// C'est lui qui redirige l'utilisateur vers les différentes pages en analysant l'URL.
// Ici, on choisit la page en fonction d'une valeur dans le $_GET.
// (on peut pas trop faire autrement sans toucher au serveur Apache...)

// Le retour se chargera aussi de gérer les exceptions avec un try / catch

require_once 'src/controllers/controleur.php';
require_once 'src/controllers/listeRecettes.php';
require_once 'src/controllers/accueil.php';
require_once 'src/controllers/pageRecette.php';
require_once 'src/controllers/pageConnexion.php';
require_once 'src/controllers/connexion.php';
require_once 'src/controllers/ListeRecettesFiltreesControleur.php';
require_once 'src/controllers/recettesAdmin.php';
require_once 'src/controllers/validationRecette.php';
require_once 'src/controllers/pageModifierEdito.php';

try{
    session_start();

    // Si 'action' n'est pas défini, on charge la page d'accueil
    if(! isset($_GET['action']) || empty($_GET['action'])){
        $accueil = new AccueilControleur();
        $accueil->executer();
        return;
    }


    $controleur = null;
    // On teste les différentes valeurs possible de 'action'
    // Si ça ne correspond à aucune page, on renvoie vers la page d'erreur
    // (pour l'instant on a pas d'autre page, donc on retourne forcément une erreur)
    switch($_GET['action']){
        case 'listeRecettes':
            $controleur = new ListeRecettesControleur;
            break;

        case 'test':
            require 'test/tests.php';
            exit();

        case 'pageConnexion':
            $controleur = new PageConnexionControleur();
            break;

        case 'erreurConnexion':
            $controleur = new PageConnexionControleur(true);
            break;

        case 'connexion':
            $controleur = new ConnexionController();
            break;

        case 'detail-recette':
            $idRecette = getVariable_GET('idRecette');
            $controleur = new PageRecetteControleur($idRecette);
            break;

        case 'recettesAdmin':
            $controleur = new RecettesAdminControleur();
            break;

        case 'examenRecette':
            $idRecette = getVariable_GET('idRecette');
            $controleur = new PageRecetteControleur($idRecette, true);
            break;

        case 'validerRecette':
            $idRecette = getVariable_GET('idRecette');
            $controleur = new ValidationRecetteControleur($idRecette);
            break;

        case 'modifier-edito':
            $controleur = new ModifierEditoControleur();
            break;

        case 'recette-filtre':
            $filtre = getVariable_GET('filtre');
            $search = getVariable_GET('search');
            $controleur = new ListeRecettesFiltreesControleur($filtre,$search);
            break;
        default:
            throw new Exception("la page demandée n'a pas été trouvée");
    }

    $controleur->executer();
}
catch(Exception $e){
    $messageErreur = $e->getMessage();
    require 'templates/erreur.php';
}

function getVariable_GET($cle){
    if(! isset($_GET[$cle]) || empty($_GET[$cle])){
        header('Location: .');
        exit;
    }
    return $_GET[$cle];
}