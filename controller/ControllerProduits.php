<?php

require_once File::build_path(array('model','ModelProduits.php'));

class ControllerProduits {

    protected static $object = 'produits';

    public static function readAll(){

        $tab_p = ModelProduits::selectAll();
        $view = 'list';
        $pagetitle = 'Liste des Produits';
        require File::build_path(array('view', 'view.php'));
    }

    public static function read()
    {
        $idProduit= $_GET['idProduit'];
        $pagetitle = "Information: $idProduit";

        $p = ModelProduits::select($idProduit);

        if ($p) {

            $view = 'detail';
            require File::build_path(array("view", "view.php"));

        } else {
            self::error("Erreur de read (Produit pas reconnu)");
        }
    }

    public static function create()
    {
        $p = NULL;
        $view = 'create';
        $pagetitle = 'Créer un Produit';
        require File::build_path(array('view', 'view.php'));
    }

    public static function created()
    {
        if (!ModelProduits::save($_GET)) {
            self::error('Ce Produit a déja été crée');

            $idProduit = $_GET['idProduit'];
            $view = 'created';
            $pagetitle = 'Liste des Produits';
            $tab_p = ModelProduits::selectAll();
            require File::build_path(array('view', 'view.php'));
        }
    }

    public static function error($error = 'Erreur')
    {
        $view = 'error';
        $pagetitle = 'Une erreur';
        require File::build_path(array("view", "view.php"));
    }


    public static function update()
    {
        $idP = $_GET['idProduit'];
        $p = ModelProduits::select($idP);

        $view = 'update';
        $pagetitle = "Mise à jour: $idP";
        require File::build_path(array("view", "view.php"));
    }

    public static function delete()
    {
        $idP = $_GET['idProduit'];
        ModelProduits::delete($idP);

        $view = 'delete';
        $pagetitle = 'Liste des Produits';

        $tab_p = ModelProduits::selectAll();
        require File::build_path(array("view", "view.php"));
    }

    public static function updated()
    {
        $idProduit = $_GET['idProduit'];
        $nomProduit = $_GET['nomProduit'];
        $image = $_GET['image'];
        $description = $_GET['description'];
        $prix = $_GET['prix'];
        $stock = $_GET['stock'];
        $promo = $_GET['promo'];

        $dataProduit = array(
            "idProduit"=> $idProduit,
            "nomProduit" => $nomProduit,
            "image" => $image,
            "description" => $description,
            "prix"=> $prix,
            "stock"=> $stock,
            "promo"=> $promo);

        ModelProduits::update($dataProduit);

        $tab_p = ModelProduits::selectAll();
        $view = 'updated';
        $pagetitle = 'Modification de votre Produit';
        require File::build_path(array('view', 'view.php'));
    }




    public static function createProduit(){
        $idProduit = $_POST['idProduit'];
        $nomProduit = $_POST['nom'];
        $image = $_POST['IMG'];
        $description = $_POST['Desc'];
        $prix = $_POST['Prix'];
        $stock = $_POST['stock'];
        $promo = $_POST['promo'];

        $dataProduit = array(
              $idProduit,
              $nomProduit,
              $nomProduit,
              $image,
              $description,
              $prix,
              $stock,
              $promo);

        $Produit = new ModelProduits($idProduit, $nomProduit, $image,$prix, $description, $stock, $promo);
        $test = $Produit->save($dataProduit);
        $controller='Produits';
        if ($test === false){
            $view = 'error';
            $pagetitle = "Erreur création d'un Produit";
            require_once(File::build_path(array("view","view.php")));

        } else {
            $view = 'created';
            $pagetitle = 'Produit crée';
            require_once(File::build_path(array("view","view.php")));
        }
    }




}
?>