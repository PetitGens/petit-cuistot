<?php

require_once 'src/lib/assertion.php';

require_once 'src/model/utilisateurManager.php';
require_once 'src/model/utilisateur.php';

testUtilisateurs();
function testUtilisateurs(){
    $manager = new UtilisateurManager();
    $motDePasse = "test";

    // Test de connexion
    $utilisateur = $manager->connecter('test', $motDePasse);

    assertTrue(! is_null($utilisateur));

    assertEquals('Jean', $utilisateur->getPrenom());
    assertEquals('Test', $utilisateur->getNom());

    // Test de la méthode getUtilisateur(string $id)
    $utilisateurBis = $manager->getUtilisateur($utilisateur->getId());

    assertEquals($utilisateur->getDateInscription(), $utilisateurBis->getDateInscription());

    // Test de la méthode getUtilisateurs()
    assertTrue(contientUtilisateur($manager->getUtilisateurs(), $utilisateur));

    // Test de la suspension d'utilisateurs
    $manager->suspendreUtilisateur($utilisateurBis);
    assertFalse($manager->getUtilisateur($utilisateurBis->getId())->estActif());
    $manager->leverSuspension($utilisateurBis);
    assertTrue($manager->getUtilisateur($utilisateurBis->getId())->estActif());

    // Test de la supression d'utilisateurs
    /*$manager->supprimerUtilisateur($utilisateur);
    assertTrue(is_null($manager->connecter('test', $motDePasse)));
    assertFalse(contientUtilisateur($manager->getUtilisateurs(), $utilisateur));*/
}

function contientUtilisateur($tab, $utilisateur){
    foreach ($tab as $element){
        if ($element->getId() == $utilisateur->getId()){
            return true;
        }
    }
    return false;
}