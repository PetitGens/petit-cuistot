<?php

function afficherPageConnexion($loginIncorrect = false) {

    $titre = 'Connexion - Ptit Cuistot';

    ob_start();

    if($loginIncorrect){ 
        echo '<p style="color: red">Identifiant / mot de passe incorrect</p>';
    }
    ?>

    <div class="container-fluid">
        <div class="row mh-100vh">
            <div class="col-10 col-sm-8 col-md-6 col-lg-6 offset-1 offset-sm-2 offset-md-3 offset-lg-0 align-self-center d-lg-flex align-items-lg-center align-self-lg-stretch bg-white p-5 rounded rounded-lg-0 my-5 my-lg-0" id="login-block">
                <div class="m-auto w-lg-75 w-xl-50">
                    <h2 class="text-info fw-light mb-5" style="border-color: var(--bs-primary);color: var(--bs-primary);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M494.6 255.9c-65.63-.8203-118.6-54.14-118.6-119.9c-65.74 0-119.1-52.97-119.8-118.6c-25.66-3.867-51.8 .2346-74.77 12.07L116.7 62.41C93.35 74.36 74.36 93.35 62.41 116.7L29.6 181.2c-11.95 23.44-16.17 49.92-12.07 75.94l11.37 71.48c4.102 25.9 16.29 49.8 34.81 68.32l51.36 51.39C133.6 466.9 157.3 479 183.2 483.1l71.84 11.37c25.9 4.101 52.27-.1172 75.59-11.95l64.81-33.05c23.32-11.84 42.31-30.82 54.14-54.14l32.93-64.57C494.3 307.7 498.5 281.4 494.6 255.9zM176 367.1c-17.62 0-32-14.37-32-31.1s14.38-31.1 32-31.1s32 14.37 32 31.1S193.6 367.1 176 367.1zM208 208c-17.62 0-32-14.37-32-31.1s14.38-31.1 32-31.1s32 14.37 32 31.1S225.6 208 208 208zM368 335.1c-17.62 0-32-14.37-32-31.1s14.38-31.1 32-31.1s32 14.37 32 31.1S385.6 335.1 368 335.1z"></path>
                        </svg>&nbsp;Ptit cuistots</h2>
                    <form method="post" action=".?action=connexion">
                        <div class="form-group mb-3"><label for="identifiant" class="form-label text-secondary">Email/nom d'utilisateur</label><input class="form-control" type="text" id="identifiant" name="identifiant" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,15}$" inputmode="email"></div>
                        <div class="form-group mb-3"><label for="motDePasse" class="form-label text-secondary">mot de passe</label><input class="form-control" type="password" id="motDePasse" name="motDePasse" required></div>
                        <button class="btn btn-info mt-2" type="submit">Se connecter</button>
                    </form>
                    <p class="mt-3 mb-0"><a class="text-uppercase small" href="#" style="color: var(--bs-primary-border-subtle);text-decoration: underline;font-family: Caveat, serif;font-size: 19px;font-weight: bold;">S'inscrire</a></p>
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-end" id="bg-block" style="background: url('assets/img/Foods_Pie_Pies_Quiche-1613921.jpg') no-repeat;background-size: cover;">

            </div>
        </div>
    </div>

    <?php
    
    $contenu = ob_get_clean();

    require 'templates/layout.php';
}