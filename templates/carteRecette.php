<?php
// Ceci est une vue bidon
// Une vue se contente de récupérer les variables qu'on lui donne est de formatter la page html

// Le code HTML sera placé en énorme majorité dans les vues et le layout


require_once('./src/model/recette.php');

function afficher($recette){?>
    <div class="col">
    <div class="d-flex flex-column flex-lg-row">
        <div class="w-100" style="max-width: initial;"><img class="rounded img-fluid d-block w-100 fit-cover" style="height: 200px;" src= "<?=$recette->getUrlImage()?>">
            <ul style="background: transparent;padding-left: 0;border: 2px none var(--bs-primary-text-emphasis) ;border-left-color: var(--bs-primary-text-emphasis);">
                <li style="background: var(--bs-primary-border-subtle);border-radius: 54px;border-top-left-radius: 0;border-bottom-left-radius: 0;text-align: center;border-style: solid;border-color: var(--bs-primary);">tag 1</li>
                <li style="background: var(--bs-primary-border-subtle);border-radius: 54px;border-top-left-radius: 0;border-bottom-left-radius: 0;text-align: center;border-style: solid;border-color: var(--bs-primary);">tag 1</li>
                <li style="background: var(--bs-primary-border-subtle);border-radius: 54px;border-top-left-radius: 0;border-bottom-left-radius: 0;text-align: center;border-style: solid;border-color: var(--bs-primary);">tag 1</li>
                <li style="background: var(--bs-primary-border-subtle);border-radius: 54px;border-top-left-radius: 0;border-bottom-left-radius: 0;text-align: center;border-style: solid;border-color: var(--bs-primary);">tag 1</li>
            </ul>
        </div>
        <div class="py-4 py-lg-0 px-lg-4" style="width: 100%;">
            <h4><?= $recette->getTitre() ?></h4>
            <p></p>
            <p><?= $recette->getResume()?></p>
        </div>
    </div>
    </div>
<?php }
