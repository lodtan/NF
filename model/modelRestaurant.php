<?php
  require_once ("{$ROOT}{$DS}model{$DS}model.php");
class ModelRestaurant extends Model {

  private $id;
  private $nom;
  private $adresse;
  private $codepostal;
  private $pays;
  protected static $table="restaurant";
  protected static $primary="id";
   
  // Les getters    
  public function getId() {
       return $this->id;  
  }

  public function getNom() {
       return $this->nom;  
  }

  public function getAdresse() {
       return $this->adresse;  
  }

  public function getCodePostal() {
    return $this->codepostal;
  }

  public function getPays() {
    return $this->pays;
  }

  // Les setters 
  public function setNom($n) {
    $this->nom = $n;
  }

  public function setAdresse($a) {
    $this->adresse = $a;
  }

  public function setCodePostal($cp) {
    $this->codepostal = $cp;
  }

  public function setPays( $p) {
    $this->pays = $p;
  }

  public static function deleteAllidResto($table, $idR) {
        $sql = "DELETE FROM " . $table . " WHERE idResto=:idResto";
        $values = array(
          'idResto' => $idR
        );
        $req_prep= Model::$pdo->prepare($sql);
        $req_prep->execute($values);
  }

  public static function selectByResto($id) {
      $sql = "SELECT *
              FROM manager m
              WHERE m.idResto=:i
              ORDER BY ".static::$primary." DESC";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "i" => $id
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'modelManager');
      // Vérifier si $req_prep->rowCount() != 0
      return $req_prep->fetchAll();
  }

  public function __construct($n = NULL, $a = NULL, $cp = NULL, $p = NULL) {
    if (!is_null($n) && !is_null($a) && !is_null($cp) && !is_null($p)) {
      $this->id = -1;
      $this->nom = $n;
      $this->adresse = $a;
      $this->codepostal = $cp;
      $this->pays = $p;
    }
  }
}
?>