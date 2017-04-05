<?php
  require_once ("{$ROOT}{$DS}model{$DS}model.php");
class ModelBoisson extends Model {

  private $nom;
  protected static $table="boisson";
  protected static $primary="nom";
   

  public function getNom() {
       return $this->nom;  
  }


  // Les setters 
  public function setNom($n) {
    $this->nom = $n;
  }

   public static function  selectAllBoissons()
   {
      $sql = "SELECT nom FROM boisson;";// SELECT idmenu, prix, nom
      
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
      $result = pg_query($conn, $sql);
      
      return $result;
    }
  
     public static function selectBoissonsNonPresent($id){
      $sql = "SELECT id, nom,volume FROM boissonvendue EXCEPT (SELECT id, nom,volume FROM boissonvendue INNER JOIN carteboisson ON boissonvendue.id=carteboisson.idboisson WHERE carteboisson.idcarte=$id);";// SELECT idmenu, prix, nom
      
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
      $result = pg_query($conn, $sql);
      
      return $result;

    }
    
    public static function selectBoissonsPresentes($idcarte)
    {
        $sql = "SELECT id, nom,volume FROM boissonvendue INNER JOIN carteboisson ON boissonvendue.id=carteboisson.idboisson WHERE carteboisson.idcarte=$idcarte;";
        
        $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
        $result = pg_query($conn, $sql);
    
        return $result;
    }
    
      public static function  addBoisson($nom, $annee)
      {
      $sql1 = "INSERT INTO boisson VALUES ('$nom', $annee);";// SELECT idmenu, prix, nom
      
      
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
      $result1 = pg_query($conn, $sql1);
      
      return 0;
    
    }
    
    public static function  addBoissonVendue($volume, $nom)
    {
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
      
      $sql2 = "SELECT annee FROM boisson WHERE nom='$nom';";
      // a faire : requete sql pour lier cette boisson à la carte passée en parametre
      
      $result2 = pg_query($conn, $sql2);
      $annee = pg_fetch_row($result2); // utiliser $annee[0]
      
      if(empty($annee[0]))
      {
            $annee[0] = 0;
      }
      $sql1 = "INSERT INTO BoissonVendue (volume, nom, annee) VALUES ($volume, '$nom', $annee[0]);";// SELECT idmenu, prix, nom
      $result1 = pg_query($conn, $sql1);
      
      
      return 0;
    

    }
    
    public static function addBoissoncarte($idcarte, $idboisson, $prix)
    {
        $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
        $sql = "INSERT INTO carteboisson VALUES ($idcarte, $idboisson, $prix);";
        $result = pg_query($conn, $sql);
        
        return 1;
        
    }
    
    public static function supprimerBoissonCarte($idcarte, $idboisson)
    {
      $sql = "DELETE FROM carteboisson WHERE idboisson=$idboisson AND  idcarte=$idcarte;";
      
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