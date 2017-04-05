<?php
  require_once ("{$ROOT}{$DS}model{$DS}model.php");
class ModelCommande extends Model {

  private $id;
  private $date;
  private $idResto;
  protected static $table="commande";
  protected static $primary="id";
   
  // Les getters    
  public function getId() {
       return $this->id;  
  }

  public function getDate() {
       return $this->date;  
  }

  public function getIdresto() {
    return $this->idresto;
  }

  // Les setters 
  public function setDate($d) {
    $this->anciennete = $d;
  }

  public function setIdresto($id) {
    $this->idresto = $id;
  }

  public static function selectCommandes($type, $id) {
      $sql = "SELECT *
              FROM Commande" . $type . " c
              WHERE c.idCommande=:i
              ORDER BY idCommande DESC";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "i" => $id
      );
      $req_prep->execute($values);
      return $req_prep->fetchAll();
  }

  public function __construct($d = NULL, $id = NULL) {
    if (!is_null($d) && !is_null($id)) {
      $this->id = -1;
      $this->date = $d;
      $this->idResto = $id;
    }
  }
}
?>