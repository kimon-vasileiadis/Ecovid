<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="view/css/style-general.css">

    <title><?php echo $pagetitle; ?></title>
</head>

<header>
    <nav>
        <div><a href=""><img src="https://www.kindpng.com/picc/m/127-1272273_doctors-logo-black-and-white-vector-png-download.png" alt=" " id="logo"></a></div>
        <a href="index.php?action=readAll">Liste des Produits</a>
        <a href='?action=update'>Créer un produit</a>
    </nav>
    <img src="images/backg.jpg" id="background" alt="arrière-plan: arrière du magasin">
    <img src="https://www.kindpng.com/picc/m/127-1272273_doctors-logo-black-and-white-vector-png-download.png" id="logohead" alt="notre logo">

</header>

<body>
<?php

$filepath = File::build_path(array("view" ,static::$object,"$view.php"));
require $filepath;
?>


<footer>
    <div id="footer">
        <div>
            <h4>
                Anti Covid Merchandise since 2022
            </h4>
        </div>
        <div>
            <p class="stay">© Ecovid 2022 </p>
        </div>
    </div>
</footer>

</body>

</html>