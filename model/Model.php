<?php

  require_once File::build_path(array('config','Conf.php'));


    Class Model
    {

        private static $pdo = NULL;
        protected static $object; //objet de classe
        protected static $primary; //clé primaire

        public static function init()
        {

            $hostname = Conf::getHostname();
            $database_name = Conf::getDatabase();
            $login = Conf::getLogin();
            $password = Conf::getPassword();

            try {
                // Connexion à la base de données
                // Le dernier argument sert à ce que toutes les chaines de caractères
                // en entrée et sortie de MySql soit dans le codage UTF-8
                self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

                // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            } catch (PDOException $e) {
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                }
                die();

            }
        }


        public static function getPDO()
        {
            if (is_null(self::$pdo)) {
                self::init();
            }
            return self::$pdo;

        }


        public static function selectAll()
        {

            $table_name = static::$object;
            $class_name = 'Model' . ucfirst(static::$object);


            try {
                $rep = self::getPDO()->query("SELECT * FROM $table_name");
                $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
                return $rep->fetchAll();
            } catch (PDOException $e) {
                if (Conf::getDebug()) {
                    echo $e->getMessage();
                } else {
                    echo "Erreur: Impossible de récupérer objet de :$class_name";
                }
                die();
            }
        }

        public static function update($data)
        {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst(static::$object);
            $primary_key = static::$primary;

            try {
                $sql = "UPDATE $table_name SET ";

                foreach ($data as $key => $value) {
                    if (property_exists($class_name, $key)) {
                        if ($key != $primary_key) {
                            $sql .= "$key=:$key,";
                        }
                    }
                }
                $sql = rtrim($sql, ",");
                $sql .= " WHERE $primary_key=:$primary_key";
                $req = self::getPDO()->prepare($sql);

                unset($data['action'], $data['controller']);
                $req->execute($data);
                return true;

            } catch (PDOException $e) {
                if (Conf::getDebug()) {
                    echo $e->getMessage();
                } else {
                    echo "Erreur: Impossible de récupérer $data[$primary_key] de $class_name";
                }
                die();
            }
        }

        public static function select($primary_value)
        {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst(static::$object);
            $primary_key = static::$primary;

            try {
                $sql = "SELECT * from $table_name WHERE $primary_key= :primary_value";
                $req_prep = self::getPDO()->prepare($sql);

                $values = array(
                    "primary_value" => $primary_value,
                );
                $req_prep->execute($values);

                $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);

                $tab_bag = $req_prep->fetchAll();

                if (empty($tab_bag))
                    return false;
                return $tab_bag[0];
            } catch (PDOException $er) {
                if (Conf::getDebug()) {
                    echo $er->getMessage();
                } else {
                    echo "Erreur: impossible de prendre $primary_value de $class_name";
                }
                die();
            }
        }

        public static function save($data)
        {
            $table_name = static::$object; // nom de la table
            $class_name = 'Model' . ucfirst(static::$object);
            $primary_key = static::$primary;

            try {
                $sql = "INSERT INTO $table_name ("; //1ère partie de l'insert
                foreach ($data as $key => $value) {
                    if (property_exists($class_name, $key)) { //vérifier si existe déja
                        $sql .= "$key,";
                    }
                }
                $sql = rtrim($sql, ",");
                $sql .= ") VALUES (";//2ème partie de l'insert
                foreach ($data as $key => $value) {
                    if (property_exists($class_name, $key)) {
                        $sql .= ":$key,";
                    }
                }
                $sql = rtrim($sql, ",");
                $sql .= ")";//dernière partie de l'insert
                $req_prep = self::getPDO()->prepare($sql);

                unset($data['action'], $data['controller']);
                $req_prep->execute($data);
                return true;

            } catch (PDOException $e) {
                if ($e->errorInfo[1] == 1452) {
                    return 2;
                } else if (Conf::getDebug()) {
                    print_r($e->errorInfo);
                } else {
                    echo "Erreur: impossible de récupérer $data[$primary_key] de $class_name";
                }
                die();
            }
        }

        public static function delete($primary_value)
        {
            $table_name = static::$object;
            $class_name = 'Model' . ucfirst(static::$object);
            $primary_key = static::$primary;

            try {
                $sql = "DELETE FROM $table_name WHERE $primary_key =:primary_value";

                $req_prep = self::getPDO()->prepare($sql);

                $values = array(
                    "primary_value" => $primary_value
                );

                $req_prep->execute($values);
                return true;

            } catch (PDOException $er) {
                if (Conf::getDebug()) {
                    echo $er->getMessage();
                } else {
                    echo "Erreur: Impossible de supprimer $primary_value de $class_name";
                }
                die();
            }
        }


    }

  

    ?>

</body>

</html> 
