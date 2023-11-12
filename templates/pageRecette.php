<?php
require_once 'src/lib/Parsedown.php';
require_once 'src/model/recette.php';
require_once 'src/model/recetteManager.php';
require_once 'src/model/ingredient.php';
require_once 'src/controllers/connexion.php';

function afficherPageRecette(Recette $recette, bool $admin){
    $titre = $recette->getTitre();

    if($admin){
        $titre = "Validation : $titre";
    }

    $Parsedown=new Parsedown();
    $Parsedown->setSafeMode(true);

    $utilisateur = ConnexionController::estConnecte();

    $peutSupprimer = false;
    
    if($utilisateur){
        if($utilisateur->estAdministrateur() || $recette->getIdAuteur() === $utilisateur->getId()){
            $peutSupprimer = true;
        }
    }

    ob_start();
    ?>

    <div data-bss-bg="true" style="text-align:center;height: 500px;padding-top: 30px;padding-right: 10px;padding-left: 10px;background-image: url(<?=$recette->getImage()?>);background-repeat: no-repeat;background-size: contain;background-position: center">
        <h1 style="margin:auto;margin-top: 20px;margin-bottom: 10%;padding: 10px;width: fit-content;text-align: center;background:rgba(192,192,192,0.75);border-radius: 5px;"><?=$recette->getTitre() ?></h1>
    </div>
    <div class="row" style="width: inherit;padding-right: 4%;padding-left: 4%;">
        <div class="col" style="overflow: auto">
            <div class="d-flex flex-row flex-nowrap" style="overflow: auto">
                <?php
                    foreach ($recette->getIngredients() as $ingredient){
                ?>
                <a class="custlnk" href ='?action=recette-filtre&filtre=ingredient&search=<?=$ingredient->getIntitule()?>' style='width: auto ;padding-right: 15px;padding-left: 15px;margin: 10px;' >
                    <div class="horitzontalScrollContent me-3 ms-2" style="width: 100%;margin: 0px;">
                        <div class="row" style="width: auto; display: inline-block"">
                            <div class="col text-center" style="width: auto;padding: 0px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em" height="1em" fill="currentColor" class="border rounded-circle p-2" style="width: 45px;height: 45px;background-color: rgba(201,201,201,0.61);font-size: 30px;">
                                    <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                    <path d="M171.7 191.1H404.3L322.7 35.07C316.6 23.31 321.2 8.821 332.9 2.706C344.7-3.409 359.2 1.167 365.3 12.93L458.4 191.1H544C561.7 191.1 576 206.3 576 223.1C576 241.7 561.7 255.1 544 255.1L492.1 463.5C484.1 492 459.4 512 430 512H145.1C116.6 512 91 492 83.88 463.5L32 255.1C14.33 255.1 0 241.7 0 223.1C0 206.3 14.33 191.1 32 191.1H117.6L210.7 12.93C216.8 1.167 231.3-3.409 243.1 2.706C254.8 8.821 259.4 23.31 253.3 35.07L171.7 191.1zM191.1 303.1C191.1 295.1 184.8 287.1 175.1 287.1C167.2 287.1 159.1 295.1 159.1 303.1V399.1C159.1 408.8 167.2 415.1 175.1 415.1C184.8 415.1 191.1 408.8 191.1 399.1V303.1zM271.1 303.1V399.1C271.1 408.8 279.2 415.1 287.1 415.1C296.8 415.1 304 408.8 304 399.1V303.1C304 295.1 296.8 287.1 287.1 287.1C279.2 287.1 271.1 295.1 271.1 303.1zM416 303.1C416 295.1 408.8 287.1 400 287.1C391.2 287.1 384 295.1 384 303.1V399.1C384 408.8 391.2 415.1 400 415.1C408.8 415.1 416 408.8 416 399.1V303.1z"></path>
                                </svg>
                                <p class="mt-2" style="font-size: 20px;color: rgb(102,99,99);width: auto;"><?=$ingredient->getIntitule()?></p>
                            </div>
                        </div>
                    </div>
                </a>
                <?php
                    }
                ?>
            </section>
        </div>
        <div class="col-12 offset-1" style="width: 100%;margin: 0px;padding-right: 0;padding-left: 0;background: var(--bs-primary-bg-subtle);margin-right: 0;margin-left: 0;border-radius: 13px;margin-top: 10px;margin-bottom: 10px;">
            <p style="padding-right: 10%;padding-left: 10%;width: inherit;">
                <?=$Parsedown->text($recette->getContenu())?>
            </p>
        </div>
        <?php
        if ($admin){
            ?><a href=".?action=validerRecette&idRecette=<?=$recette->getId()?>">Valider la recette</a><?php
        }

        if($peutSupprimer){
        ?>
            <a href="#">
                <img id="iconeSpr"src="assets/img/poubelle.png" alt="icone poubelle" style="height: 50px; width: 50px; margin-bottom: 10px; margin-right: 10px; margin-left: 80%;">
            </a>
            <script src= "assets/js/suppression.js"></script>
        <?php
        }
        ?>
    </div>
    <?php
    $contenu = ob_get_clean();

    require 'templates/layout.php';
}
?>