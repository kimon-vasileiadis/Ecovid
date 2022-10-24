<?php

 require_once File::build_path(array('model','Model.php'));

    class ModelProduits extends Model {

        private $idProduit;
        private $nomProduit;
        private $description;
        private $image;
        private $stock;
        private $promo;
        private $prix;


        protected static $object = 'produits';
        protected static $primary = 'idProduit';



        public function getIdProduit(){
            return $this->idProduit;
        }

        public function getnomProduit(){
            return $this->nomProduit;
        }

        public function getImage(){
            return $this->image;
        }

        public function getPrix(){
            return $this->prix;
        }

        public function getDescription(){
            return $this->description;
        }

        public function getStock(){
            return $this->stock;
        }

        public function getPromo(){
            return $this->promo;
        }




        public function setIdProduit($idProduit)
        {
            $this->idProduit = $idProduit;
        }

        public function setnomProduit($nomProduit){
            $this->nomProduit = $nomProduit;
        }

        public function setImage($im){
            $this->image = $im;
        }

        public function setDescription($desc){
            $this->description = $desc;
        }

        public function setPrix($prx){
            $this->prix = $prx;
        }

        public function setStock($stock){
            $this->stock = $stock;
        }

        public function setPromo($promo){
            $this->promo = $promo;
        }






        public function __construct( $idP = NULL,$nomP = NULL, $im = NULL, $desc = NULL, $prx = NULL, $stock = NULL, $promo = NULL) {
            if (!is_null($idP) && !is_null($nomP) && !is_null($im) && !is_null($stock)) {
                 $this->idProduit = $idP;
                 $this->nomProduit = $nomP;
                 $this->image = $im;
                 $this->description = $desc;
                 $this->prix = $prx;
                 $this->stock = $stock;
                 $this->promo = $promo;
                }
        }

        public function afficher() {

          echo " $this->idProduit \n
          $this->nomProduit \n
          $this->image \n
          $this->description \n
          $this->prix \n
          $this->promo
          $this->stock";
        }

        public static function getAllByID($nomProduit) {
            $pdo = Model::getPDO();
            $rep = $pdo->query("SELECT * FROM produits WHERE idProduit = '$idProduit'");
            $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
            /*  var_dump($det, 'SELECT descr FROM article WHERE id = "$id"');
              die;*/
            return $rep->fetchAll();
        }
    }