
<?php
// Ceci est une vue bidon
// Une vue se contente de récupérer les variables qu'on lui donne est de formatter la page html


include_once 'src/model/recette.php';
include_once 'src/model/recetteManager.php';

// Le code HTML sera placé en énorme majorité dans les vues et le layout



$titre = 'ptitcuistot';

// ob_start crée un buffer qui va récupérer tout ce qui est censé être affiché (echo + HTML) 
ob_start();
?>
    <div class="container py-4 py-xl-5"><img style="width: 100%;height: 20em;" src="assets/img/batiment.png">
        <div class="row mb-5">
            <div class="col" style="background: var(--bs-primary);width: auto;max-width: 100%;--bs-body-color: #ffffff;min-width: 30%;">
                <div style="background: transparent;text-align: center;"><img width="480" height="480" style="padding-top: 0px;width: 60%;height: 200%;min-width: 200px;min-height: 200px;margin: 20px;display: inline-grid;margin-right: auto;margin-left: auto;" src="assets/img/Pticuisto.png">
                    <div style="display: inline-block;">
                        <h1 style="font-size: 50px;color: white;">Edito</h1>
                        <p style="font-size: 28px;color: white;font-family: Caveat, serif;"><strong>Il y a quelque chose de magique à voir nos enfants se lancer dans la cuisine avec enthousiasme, arborant fièrement leur tablier, et préparant des mets délicieux avec une innocence toute spéciale. C'est précisément cette magie que nous souhaitons capturer ici, sur notre site internet dédié aux talents culinaires en herbe.<br>
                            <br>Notre site célèbre la créativité des jeunes chefs en herbe. Vous y trouverez une variété de recettes concoctées par des enfants, partageant ainsi leur passion pour la cuisine. Des plats simples aux desserts gourmands, explorez ces délices et laissez-vous inspirer par nos petits cuistots. Rejoignez-nous pour célébrer l'art culinaire des enfants !<br>
                            <br>À vos fourneaux,
                            <br><br>L'équipe de "Petits Cuistots".</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>Les dernières recettes</h2>
                
                <?php
                foreach($recettes as $recette){
                ?>
                    <div class="row">
                        <div class="col" style="text-align: left;"><a href="index.php?action=detail-recette&=idRecette=<?=$recette->getId()?>"><img style="width: 50%;display: inline-block;position: initial;margin: 15px;padding: initial;margin-left: 0px;" src="<?=$recette->getImage()?>"></a>
                            <div style="display: inline-block;">
                                <h1 style="width: 50%;display: block;"><a href="index.php?action=detail-recette&=idRecette=<?=$recette->getId()?>"><?=$recette->getTitre()?></a></h1>
                                <p style="display: block;"><?=$recette->getResume()?></p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
<?php

// On peut récupérer le contenu du buffer comme ça :
$contenu = ob_get_clean();

// On inclut le layout pour afficher notre belle page
require 'templates/layout.php';
