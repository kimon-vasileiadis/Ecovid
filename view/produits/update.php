<?php

error_reporting(0);
$update = $p != NULL;

if ($update) {

    $idProduit = rawurldecode($p->getIdProduit());
    $nomProduit = htmlspecialchars($p->getnomProduit());
    $image = htmlspecialchars($p->getImage());
    $description = htmlspecialchars($p->getDescription());
    $prix   = htmlspecialchars($p->getPrix());
    $stock = htmlspecialchars($p->getStock());
    $promo = htmlspecialchars($p -> getPromo());

} else {

    $idProduit = "";
    $nomProduit = "";
    $image = "";
    $description ="";
    $prix = "";
    $stock = "";
    $promo = "";
}
?>

<form method="get" action="index.php?&action=updated">

    <fieldset>
        <legend><?php echo ("Modifier un Produit $nomProduit"); ?></legend>
        <p>
            <input type='hidden' name='action' value='created'>
        </p>
        <p>
            <label for="idProduit">ID</label> :
            <input type="text" placeholder="Ex : Truc" name="nom" id="idProduit" value="<?php echo $idProduit; ?>" required/>
        </p>
        <p>
            <label for="nomProduit">Nom</label> :
            <input type="text" placeholder="Ex : Truc" name="nom" id="nomProduit" value="<?php echo $nomProduit; ?>" required/>
        </p>
        <p>
            <label for="image">image</label>
            <input type = "file" placeholder="link" name="image" id="image" value="<?php echo $image; ?>" required/>
        </p>
        <p>
            <label for="description">Description</label> :
            <input type="text" placeholder="Ex : Blabla" name="desc" id="description" value="<?php echo $description; ?>" required/>
        </p>
        <p>
            <label for="prix">Prix</label> :
            <input type="text" placeholder="Ex : 50 euros" name="prix" id="prix" value="<?php echo $prix ?>" required/>
        </p>
        <p>
            <label for="stock">Stock</label> :
            <input type="text" placeholder="Ex : 5O unités" name="stock" id="stock" value="<?php echo $stock ?>" required/>
        </p>
        <p>
            <label for="promo">Promo</label> :
            <input type="checkbox" name="promo" id="promo" value="<?php echo $promo ?>" required/>
        </p>
        <p></p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>

        <input type='hidden' name='action' value='<?php echo ($update ? "updated" : "created") ?>'>
        <input type='hidden' name='controller' value='Controller<?php echo ucfirst(static::$object) ?>'>

    </fieldset>
</form>
