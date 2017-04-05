<?php
  require_once ("{$ROOT}{$DS}model{$DS}model.php");
class ModelVille extends Model {

  private $codepostal;
  private $pays;
  private $nom;
  protected static $table="ville";
  protected static $primary=array('codepostal','pays');
   
  // Les getters    
  public function getCodePostal() {
       return $this->codepostal;  
  }

  public function getPays() {
    return $this->pays;
  }

  public function getNom() {
       return $this->nom;  
  }

  // Les setters 
  public function setCodePostal($cp) {
    $this->codepostal = $cp;
  }

  public function setPays( $p) {
    $this->pays = $p;
  }

  public function setNom($n) {
    $this->nom = $n;
  }

  public static function selectAll() {
      $rep=Model::$pdo->query("SELECT * FROM ville ORDER BY nom");
      $rep->setFetchMode(PDO::FETCH_CLASS, 'modelVille');
      return $rep->fetchAll();
  }

  public static function selectByCPPays($cp, $p) {
      $sql = "SELECT *
              FROM ville v
              WHERE v.codepostal=:cp
              AND v.pays=:p
              ORDER BY nom";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "cp" => $cp,
        "p" => $p
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'modelVille');
      return $req_prep->fetch();
  }

  public function __construct($cp = NULL, $p = NULL, $n = NULL) {
    if (!is_null($cp) && !is_null($p) && !is_null($n)) {
      $this->codepostal = $cp;
      $this->pays = $p;
      $this->nom = $n;
    }
  }
}
?>