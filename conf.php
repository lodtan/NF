<?php
class Conf {
   
  static private $databases = array(

    'hostname' => 'tuxa.sme.utc',

    'database' => 'dbnf17p017',

    'login' => 'nf17p017',

    'password' => 'atEj2WfQ'
  );
   
  static public function getLogin() {
    //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
    return self::$databases['login'];
  }

  static public function getHostname() {
    return self::$databases['hostname'];
  }

  static public function getDatabase() {
    return self::$databases['database'];
  } 

  static public function getPassword() { 
    return self::$databases['password'];
  }
   
}
?>