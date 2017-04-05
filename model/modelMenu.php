<?php
  require_once ("{$ROOT}{$DS}model{$DS}model.php");
class ModelMenu extends Model {

  private $id;
  private $nom;
  protected static $table="menu";
  protected static $primary="id";
   
  // Les getters    
  public function getId() {
       return $this->id;  
  }

  public function getNom() {
       return $this->nom;  
  }

  // Les setters 
  public function setNom($n) {
    $this->nom = $n;
  }

 
  public function __construct($n = NULL) {
    if (!is_null($n)) {
      $this->id = -1;
      $this->nom = $n;
    }
  }
}
?>