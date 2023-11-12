<?php

require_once 'src/model/editoManager.php';

if (isset($_POST['redirect'])) {
    // Récupérer le contenu du textarea
    $contenuEdito = $_POST['contenuEdito'];

    // Chemin vers le fichier dans lequel tu veux écrire le contenu
    $cheminFichier = "assets/edito.txt";

    // Écrire le contenu dans le fichier
    file_put_contents($cheminFichier, $contenuEdito);
    header("Location: .");
    exit();
}

function afficherPageEdito(){
    $titre = 'Edito';

    // ob_start crée un buffer qui va récupérer tout ce qui est censé être affiché (echo + HTML) 
    ob_start();
    ?>
    <div style ="text-align: center">
        <h1>Modifier l'edito : </h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <textarea  name="contenuEdito" style="min-height: 500px; min-width: 480px; resize: none; height: 70%; width: 40%"></textarea>
            </br>
            <input name="redirect" id ="modifierEdito" type="submit" style="font-family: sans-serif;font-size: 25px;  background: var(--bs-primary); color: white">
        </form>
    </div>
    <?php
        

    $contenu = ob_get_clean();
    require 'templates/layout.php';
}