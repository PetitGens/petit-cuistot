<?php
// Ceci est une vue bidon
// Une vue se contente de récupérer les variables qu'on lui donne est de formatter la page html

// Le code HTML sera placé en énorme majorité dans les vues et le layout


require_once './src/model/recette.php';
require_once './src/model/tag.php';


function afficher($recette){
    $lienRecette = ".?action=detail-recette&idRecette=".$recette->getId()?>
    <div class="col hidden">
        <a href="<?= $lienRecette ?>" style="all: unset; cursor: pointer">
            <div class="d-flex flex-column flex-lg-row" style="border : 2px solid black; border-radius : 6px" > 
                <div class="w-100" style="max-width: initial;"><img class="rounded img-fluid d-block w-100 fit-cover" style="height: 200px;" src= "<?=$recette->getImage()?>">
                    <ul style="background: transparent;padding-left: 0;border: 2px none var(--bs-primary-text-emphasis) ;border-left-color: var(--bs-primary-text-emphasis); list-style-type : none;">
                        <?php 
                        foreach($recette->getTags() as $tag){?>
                            <li style="background: var(--bs-primary-border-subtle);border-radius: 54px;border-top-left-radius: 0;border-bottom-left-radius: 0;text-align: center;border-style: solid;border-color: var(--bs-primary);"> <?= $tag->getIntitule()?></li>
                        <?php } ?>    
                    </ul>
                </div>
                <div class="py-4 py-lg-0 px-lg-4" style="width: 100%;">
                    <h4><?= $recette->getTitre() ?></h4>
                    <p style="font-weight :bold"><?= $recette->getCategorie()?></p>
                    <p><?= $recette->getResume()?></p>
                </div>
            </div>
        </a>
    </div>
<?php }
