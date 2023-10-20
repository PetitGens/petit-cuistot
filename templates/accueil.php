<?php
// Ceci est une vue bidon
// Une vue se contente de récupérer les variables qu'on lui donne est de formatter la page html

// Le code HTML sera placé en énorme majorité dans les vues et le layout

$titre = 'Page bidon';

// ob_start crée un buffer qui va récupérer tout ce qui est censé être affiché (echo + HTML) 
ob_start();
?>

<h1>Ceci est un page bidon</h1>

<?php for($i = 0; $i < $nb; $i++) { ?>

<p>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos maiores tempore dolore obcaecati ea, exercitationem, harum commodi aut laudantium nobis culpa sequi. Dolores optio assumenda quidem earum. Velit, in? Eos.
</p>

<?php
}

// On peut récupérer le contenu du buffer comme ça :
$contenu = ob_get_clean();

// On inclut le layout pour afficher notre belle page
require 'templates/layout.php';