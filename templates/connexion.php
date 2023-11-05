<?php

function afficherPageConnexion($loginIncorrect = false) {
    //TODO styliser la page avec Bootstrap Studio

    $titre = 'Connexion - Ptit Cuistot';

    ob_start();

    if($loginIncorrect){ 
        echo '<p style="color: red">Identifiant / mot de passe incorrect</p>';
    }
    ?>

    <form action=".?action=connexion" method="post">
        <label for="identifiant">Nom d'utilisateur / email</label>
        <input type="text" placeholder="Votre nom d'utilisateur" id="identifiant" name="identifiant">
        <br><br>
        <label for="motDePasse">Mot de passe</label>
        <input type="password" placeholder="Votre mot de passe" id="motDePasse" name="motDePasse">
        <br><br>
        <input type="submit" value="Connexion">
    </form>

    <?php
    
    $contenu = ob_get_clean();

    require 'templates/layout.php';
}