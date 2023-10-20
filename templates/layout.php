<!-- Une page de base paramétrable -->

<!-- Pour l'utiliser, on remplira les différentes variables 
(ici $titre et $contenu) puis on fera un require -->

<!-- Cette page sera utilisé par les vues -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$titre?></title>
</head>
<body>
    <?=$contenu?>
</body>
</html>