<?php

$idProduit_u = rawurldecode($p->getIdProduit());
$idProduit = htmlspecialchars($p->getIdProduit());
$nomProduit = htmlspecialchars($p->getnomProduit());
$image = htmlspecialchars($p->getImage());
$description = htmlspecialchars($p->getDescription());
$prix   = htmlspecialchars($p->getPrix());
$stock = htmlspecialchars($p->getStock());
$promo = htmlspecialchars($p -> getPromo());

echo "<img src='$image' width='500' height='200'> <p> $nomProduit  </p><p> $description </p> Stock: $stock <p> </p><p>$prix €</p> <p> En promo : $promo</p>";
echo "<a href='?action=delete&idProduit=$idProduit'>Supprimer</a> ";
echo "<a href='?action=update&idProduit=$idProduit'>Mettre à jour</a>";


