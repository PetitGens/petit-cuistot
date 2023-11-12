<?php

require_once 'src/controllers/controleur.php';

require_once 'src/model/utilisateur.php';
require_once 'src/model/utilisateurManager.php';

class ConnexionController extends Controleur {
    private static $utilisateur = null;
    private static $execute = false;

    public function executer() {
        if(! isset($_POST['identifiant']) || ! isset($_POST['motDePasse'])) {
            throw new Exception('Un des champs est manquant pour la connexion.');
        }

        $utilisateur = (new UtilisateurManager)->connecter($_POST['identifiant'], $_POST['motDePasse']);

        if(is_null($utilisateur)) {
            header('Location: .?action=erreurConnexion');
            exit();
        }

        $_SESSION['idUtilisateur'] = $utilisateur->getId();

        if(isset($_SESSION['dernierePage'])){
            header('Location: '. $_SESSION['dernierePage']);
            exit();
        }

        header('Location: .');
    }

    public static function estConnecte() {
        if(self::$execute) {
            return self::$utilisateur;
        }
        self::$execute = true;
        
        if(! isset($_SESSION['idUtilisateur'])) {
            return false;
        }

        self::$utilisateur = (new UtilisateurManager)->getUtilisateur($_SESSION['idUtilisateur']);

        return self::$utilisateur;
    }

    
}
