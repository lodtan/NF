<?php
  require_once ("{$ROOT}{$DS}model{$DS}model.php");
class ModelIngredient extends Model {

  private $nom;
  protected static $table="ingredient";
  protected static $primary="nom";
   

  public function getNom() {
       return $this->nom;  
  }


  // Les setters 
  public function setNom($n) {
    $this->nom = $n;
  }
public static function addIngredient($nom){
      $sql = "INSERT INTO ingredient VALUES ('$nom');";// SELECT idmenu, prix, nom
      
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
      $result = pg_query($conn, $sql);
      
      return $result;
    }


  public static function selectAllIngredient(){
      $sql = "SELECT nom FROM ingredient;";// SELECT idmenu, prix, nom
      
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
      $result = pg_query($conn, $sql);
      
      return $result;
    }

  public function __construct($n = NULL) {
    if (!is_null($n)) {
      $this->nom = $n;
    }
  }
}
?>