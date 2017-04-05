<?php
  require_once ("{$ROOT}{$DS}model{$DS}model.php");
class ModelCarte extends Model {


  private $id;
  protected static $table="carte";
  protected static $primary="id";
   
  // Les getters    
  public function getId() {
       return $this->id;  
  }
  
  public static function selectByPeriod($id){
      $sql = "SELECT * FROM periode WHERE idresto=$id AND now()>=datedebut AND now()<=datefin;"; // ".$id. "
      /*$req_prep = Model::$pdo->prepare($sql);
      $values = array(
        "i" => $id
      );*/
      //echo $sql;
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
      
      if (!$conn) {
	echo "Une erreur s'est produite.\n";
	
      }
      else
      {
	//echo "reussi";
      }
      
      $result = pg_query($conn, $sql);
      if (!$result) {
	echo "Une erreur s'est produite.\n";

      }
      else
      {
	//echo "reussi";
      }
      
      /*while ($row = pg_fetch_row($result)) {
	echo $row[2];
      }*/
      
      //$row = pg_fetch_row($result);
      $row = 0;
      
      return $result;
  }
  
  public static function selectMenus($id){
      $sql = "SELECT * FROM cartemenu INNER JOIN menu ON cartemenu.idmenu=menu.id WHERE cartemenu.idcarte = $id;";// SELECT idmenu, prix, nom
      
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
      $result = pg_query($conn, $sql);
      
      return $result;

  }
  
   public static function selectPlats($id){
      $sql = "SELECT * FROM carteplat INNER JOIN plat ON carteplat.idplat=plat.id WHERE carteplat.idcarte = $id;";// SELECT idmenu, prix, nom
      
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
      $result = pg_query($conn, $sql);
      
      return $result;

  }
  
     public static function selectAllPlats($id){
      $sql = "SELECT * FROM plat;";// SELECT idmenu, prix, nom
      
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
      $result = pg_query($conn, $sql);
      
      return $result;

  }
  
  
     public static function selectPlatsNonPresent($id){
      $sql = "SELECT id, nom FROM plat EXCEPT (SELECT id, nom FROM plat INNER JOIN carteplat ON plat.id=carteplat.idplat WHERE carteplat.idcarte=$id) ;";// SELECT idmenu, prix, nom
      
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
      $result = pg_query($conn, $sql);
      
      return $result;

  }
  public static function supprimerPlat($idcarte, $idplat)
  {
  
      $sql = "DELETE FROM carteplat WHERE idplat=$idplat AND  idcarte=$idcarte;";
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
      $result = pg_query($conn, $sql);
      
      return $result;
  }
  
  public static function selectBoissons($id){
      $sql = "SELECT * FROM boissonvendue INNER JOIN carteboisson ON carteboisson.idboisson=boissonvendue.id WHERE carteboisson.idcarte = $id;";// SELECT idmenu, prix, nom
      
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
      $result = pg_query($conn, $sql);
      
      return $result;

  }
  
  
    public static function  detailMenu($id){
      $sql = "SELECT * FROM plat INNER JOIN platmenu ON platmenu.idplat=plat.id WHERE platmenu.idmenu=$id;";// SELECT idmenu, prix, nom
      
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
      $result = pg_query($conn, $sql);
      
      return $result;

  }
   public static function  detailPlat($idplat){
      $sql = "SELECT * FROM ingredientplat WHERE idplat=$idplat;";
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
      $result = pg_query($conn, $sql);
      
      return $result;

  }
  

  
      public static function  createCarte($datedeb, $datefin, $idresto){
      $sql1 = "INSERT INTO carte VALUES (DEFAULT);";// SELECT idmenu, prix, nom
      
      //$dd = DateTime::createFromFormat('Ymd', $datedeb);
      //$df = DateTime::createFromFormat('Ymd', $datefin);
      $sql2 = "INSERT INTO periode VALUES ( (SELECT MAX(id) FROM carte), $idresto,  '$datedeb', '$datefin');";
      
      
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
      $result1 = pg_query($conn, $sql1);
      $result2 = pg_query($conn, $sql2);
      
      return 0;
      

  }
  
  
  
  
  public static function addPlat($nom, $entree, $plat, $dessert, $categorie, $prix, $idcarte)
  {
    if($prix >0)
    {
        $sql1 = "INSERT INTO plat (id, nom, entree, plat, dessert, categorie) VALUES (DEFAULT, '$nom', '$entree', '$plat', '$dessert', '$categorie');";
        $sql2 = "SELECT MAX(id) FROM plat;";
        
        $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
        
        
        
        $result1 = pg_query($conn, $sql1);
        $result2 = pg_query($conn, $sql2);
        $retour = pg_fetch_row($result2);
    
        $sqlCartePlat = "INSERT INTO carteplat VALUES ($idcarte, $retour[0], $prix);";
        $result2 = pg_query($conn, $sqlCartePlat);
        
        return $retour[0];  //retourne l'id du plat créé
    }
  }
  
  public static function updatePlat($id, $nom, $entree, $plat, $dessert, $idcarte, $prix, $cate)
  {
          $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");

        $sql = "UPDATE plat  SET nom='$nom', entree=$entree, plat=$plat, dessert=$dessert, categorie='$cate' WHERE id=$id;";
        
        $sql2 = "UPDATE carteplat SET prix=$prix WHERE idplat=$id AND idcarte=$idcarte";
        
        
         $result1 = pg_query($conn, $sql);
         $result1 = pg_query($conn, $sql2);
         return $result1;
        
        
  }
  
  public static function addIngredientPlat($idplat, $ingredient, $quantite, $mesure, $nombre)
  {
        $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
        
        for ($i= 0; $i < $nombre; $i++)
        {
            $sql = "INSERT INTO ingredientplat VALUES ($idplat, '$ingredient[$i]', $quantite[$i], '$mesure[$i]');";
        
            $result1 = pg_query($conn, $sql);
        
        }
        
        return 1;
  }
  
  public static function ajoutPlatExistant($idcarte, $idplat, $prix)
  {
      $sql1 = "INSERT INTO carteplat VALUES ($idcarte, $idplat, $prix);";// SELECT idmenu, prix, nom
      
      // a faire : requete sql pour lier cette boisson à la carte passée en parametre
      
      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
      $result1 = pg_query($conn, $sql1);
      
      return 0;
      echo "succes";
  }
    
    public static function ajoutMenuPlat($idcarte, $idplats, $nombre, $prix, $nom)
    {
          $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
        // Ajouter à : menu, cartemenu, menuplat 
        $sql1 = "INSERT INTO menu (nom) VALUES ('$nom');";
        $result1 = pg_query($conn, $sql1);
        $sql2 = "SELECT MAX(id) FROM menu;";
        $result2 = pg_query($conn, $sql2);
        $idmenu = pg_fetch_row($result2);
        $sql3 = "INSERT INTO cartemenu VALUES ($idcarte, $idmenu[0], $prix)";
        $result3 = pg_query($conn, $sql3);
        for ($i= 0; $i < $nombre; $i++)
        {
            $sql = "INSERT INTO platmenu VALUES ($idplats[$i], $idmenu[0]);";
            //echo "dans le model : $sql <br>";
            $result1 = pg_query($conn, $sql);
        
        }
        return 1;
    }

  public function __construct() {
 
      $this->id = -1;
  }
}
?>