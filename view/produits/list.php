
<body>

<?php

foreach ($tab_p as $p) {

    $idProduit_u = rawurlencode($p->getIdProduit());
    $idProduit = htmlspecialchars($p->getIdProduit());
    $nomProduit = rawurldecode($p->getnomProduit());
    $image = htmlspecialchars($p->getImage());

    echo "<p><a href='?action=read&idProduit=$idProduit'>$image</a></p>";
    echo "<p>Produit : <a href='?action=read&idProduit=$idProduit'>$nomProduit</a></p>";
}

?>

</body>