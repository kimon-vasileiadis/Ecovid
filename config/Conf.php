<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
   
<body>

<?php

class Conf {
  
  static private $debug = True;
   
  static private $databases = array(
 
   
    'hostname' => 'localhost',
 
    'database_name' => 'ecovid' ,
  
    'login' => 'root',
  
    'password' => 'root',

  );
   
  static public function getLogin() {
    //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
    return self::$databases['login'];
  }

  static public function getHostName(){
    return self::$databases['hostname'];
  }

  static public function getDatabase(){
    return self::$databases['database_name'];
  }

  static public function getPassword(){
    return self::$databases['password'];
  }

  static public function getDebug() {
        return self::$debug;
  }
   
}

?>

</body>

</html>