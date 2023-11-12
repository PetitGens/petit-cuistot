<?php 

// Cette vue affiche simplement une erreur avec son message.
// (pour plus d'information sur les vues, voir accueil.php)

$titre = 'Erreur survenue';

ob_start();

?>

<h2 style="color:red">Une erreur est survenue pendant le chargement de la page.</h2>

<p>Raison <strong><?=$messageErreur?></strong></p>

<?php

$contenu = ob_get_clean();

require 'templates/layout.php';