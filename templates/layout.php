<!-- Une page de base paramétrable -->

<!-- Pour l'utiliser, on remplira les différentes variables 
(ici $titre et $contenu) puis on fera un require -->

<!-- Cette page sera utilisé par les vues -->

<?php
require_once 'src/controllers/connexion.php';

$connecte = ConnexionController::estConnecte();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?=$titre?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Caveat&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Permanent+Marker&amp;display=swap">
    <link rel="stylesheet" href="assets/css/swiper-icons.css">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/Navbar-Centered-Links-icons.css">
    <link rel="stylesheet" href="assets/css/Projects-Grid-images.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider-swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-md bg-dark py-3" data-bs-theme="dark" style="height: inherit;font-family: 'Permanent Marker', serif;">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="#" style="width: 200px;height: 70px;padding: 0px;margin: 0px;"><span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon" style="transform: translate(0px);width: inherit;height: inherit;margin: 5mm;background: transparent;margin-right: 5mm;"><img src="assets/img/Logo.png" style="width: inherit;display: flex;position: static;overflow: auto;height: inherit;margin: initial;"></span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-5" style="font-family: sans-serif;font-size: 25px;">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item"><a class="nav-link active" href=".">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href=".?action=listeRecettes">Nos recettes</a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="true" data-bs-toggle="dropdown" href="#">Filtres&nbsp;</a>
                        <div class="dropdown-menu has-submenu" data-bs-popper="none" style="--bs-body-bg: var(--bs-primary);background: var(--bs-secondary);" data-bs-theme="light">
                            <a id="tag" class="dropdown-item" data-bs-theme="light"><span style="color: rgb(42, 57, 144); background-color: rgba(42, 57, 144, 0);">Tag</span></a>
                            <a id="titre" class="dropdown-item" ><span style="color: rgb(42, 57, 144);">Titre</span></a>
                            <a id="ingredients" class="dropdown-item"><span style="color: rgb(42, 57, 144);">Ingredients</span></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="true" data-bs-toggle="dropdown" href="#">Catégories&nbsp;</a>
                        <div class="dropdown-menu has-submenu" data-bs-popper="none" style="--bs-body-bg: var(--bs-primary);background: var(--bs-secondary);" data-bs-theme="light">
                            <?php
                            foreach ((new CategorieManager())->getCategories() as $category ){
                                ?><a class="dropdown-item" data-bs-theme="light" href="?action=recette-filtre&filtre=categorie&search=<?=$category?>"><span style="color: rgb(42, 57, 144); background-color: rgba(42, 57, 144, 0);"><?=$category?></span></a>
                            <?php ;}
                            ?>
                        </div>
                    </li>

                    <?php
                    if($utilisateur){
                        ?>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle nav-link" aria-expanded="true" data-bs-toggle="dropdown" href="#" style="background: var(--bs-primary);border-radius: 22px;color: var(--bs-light-text-emphasis);">Profil&nbsp;
                                <img src="assets/img/Pticuisto.png" style="width: 2em;height: 2em;">
                            </a>
                            <div class="dropdown-menu" data-bs-popper="none" style="--bs-body-bg: var(--bs-primary);background: var(--bs-secondary);">
                                <a class="dropdown-item" href="#">Mes recettes</a>
                                <a class="dropdown-item" href="#">Nouvelle Recette</a>
                                <?php if ($utilisateur->estAdministrateur()){
                                    ?>
                                    <a class="dropdown-item" href="?action=recettesAdmin">Recettes a valider</a>
                                    <a class="dropdown-item" href="?action=modifier-edito">Modifier l'édito</a>
                                    <?php
                                }?>
                                <a class="dropdown-item" id="boutonDeconnexion" href="#">Se Déconnecter</a>
                            </div>
                        </li>
                        <?php
                    }
                    else{
                        ?>
                            <a class="btn btn-primary ms-md-2" role="button" href="?action=pageConnexion" style="color: #ffffff;border-left-color: var(--bs-btn-border-color);box-shadow: 0px 0px var(--bs-light);font-size: 23px;">
                                Se connecter
                            </a>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="row visually-hidden" id="searchbar">
        <div class="col-md-10 offset-md-1">
            <div class="card m-auto" style="max-width:850px">
                <div class="card-body">
                    <form class="d-flex align-items-center" action="index.php" method="get">
                        <input type="hidden" name="action" value="recette-filtre">
                        <i class="fas fa-search d-none d-sm-block h4 text-body m-0"></i>
                        <input class="form-control form-control-lg flex-shrink-1 form-control-borderless" type="search" placeholder="recherchez" name="search">
                        <input type="hidden" id="filtre" name="filtre" value="">
                        <p class="visually-hidden" id="info_recherche">ecrivez les éléments séparés par des virgules</p>
                        <button class="btn btn-success btn-lg" type="submit">Search</button></form>
                </div>
            </div>
        </div>
    </div>
    <?=$contenu?>
    <footer class="text-center" style="background: var(--bs-primary);">
        <div class="container text-white py-4 py-lg-5" style="background: var(--bs-primary);">
            <ul class="list-inline">
                <li class="list-inline-item me-4" style="width: 60px;height: 60px;background: var(--bs-tertiary-bg);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512" width="1em" height="1em" fill="currentColor" class="text-light" style="width: inherit;height: inherit;border-left-color: rgb(255,255,255);--bs-light: #1977F3;--bs-light-rgb: 25,119,243;">
                        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z"></path>
                    </svg></li>
                <li class="list-inline-item me-4" style="width: 60px;height: 60px;background: #00ADEF;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-twitter text-light" style="width: inherit;height: inherit;--bs-light: white;--bs-light-rgb: 255,255,255;">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
                    </svg></li>
                <li class="list-inline-item" style="width: 60px;height: 60px;background: white;border-radius: 72px;border-style: hidden;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-linkedin text-light" style="width: 100%;max-width: 200px;height: 100%;--bs-light: #0A66C2;--bs-light-rgb: 10,102,194;border-width: 2.4px;border-style: solid;border-left-color: #0A66C2;">
                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"></path>
                    </svg></li>
            </ul>
            <p>Copyright&nbsp;©Les cuistots du dimanche 2023</p>
        </div>
    </footer>
    <script src="/assets/js/menuRecherche.js"
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Simple-Slider-swiper-bundle.min.js"></script>
    <script src="assets/js/Simple-Slider.js"></script>
    <script src="assets/js/deconnexion.js"></script>
    <?php if(isset($script)) echo $script ?>
</body>
</html>