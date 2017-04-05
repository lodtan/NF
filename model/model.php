<?php
	require_once ("{$ROOT}{$DS}conf.php");

	class Model {
		public static $pdo;

		public static function Init() {
			$host = Conf::getHostname();
			$dbname = Conf::getDatabase();
			$login = Conf::getLogin();
			$pass = Conf::getPassword();
			
			
			
			try {
				// Connexion à la base de données            
				// Le dernier argument sert à ce que toutes les chaines de caractères 
				// en entrée et sortie de MySql soit dans le codage UTF-8
				self::$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $login, $pass);
				// On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
				self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e) {
 				echo $e->getMessage(); // affiche un message d'erreur
  				die();
			}
			
			
		}

		public static function selectAll() {
			$rep=Model::$pdo->query("SELECT * FROM ".static::$table." ORDER BY ".static::$primary." DESC");
      		$rep->setFetchMode(PDO::FETCH_CLASS, 'model'.static::$table);
      		return $rep->fetchAll();
  		}

  		public static function select($p) {
   	 		$sql = "SELECT * FROM ".static::$table." WHERE ".static::$primary."=:primary";
		    $req_prep = Model::$pdo->prepare($sql);
		    $values = array(
		     "primary" => $p
		    );
		    $req_prep->execute($values);
		    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'model'.static::$table);
		    // Vérifier si $req_prep->rowCount() != 0
		    return $req_prep->fetch();
		}

		public static function delete($p) {
		    $sql = "DELETE FROM ".static::$table." WHERE ".static::$primary."=:primary";
		    $values = array(
		      'primary' => $p
		    );
		    $req_prep= Model::$pdo->prepare($sql);
		    $req_prep->execute($values);
		}

		public static function update($data) {
			$set="";$where="";
			foreach ($data as $cle => $valeur) {
				if ($cle==static::$primary) {
					$set="=:$cle,";
					$where=$set;
				}
				else {
					$set=$set." $cle=:$cle,";
				}
			}
			$set=rtrim($set,',');
			$where=rtrim($where,',');
		    $sql="UPDATE ".static::$table." SET ".static::$primary.$set." WHERE ".static::$primary.$where;
		    $req_prep= Model::$pdo->prepare($sql);
		    $req_prep->execute($data);
		}

		public static function save($data) {
			$values="";
			$cles="";
			foreach ($data as $cle => $valeur) {
				$cles=$cles." $cle,";
				$values=$values." :$cle,";
			}
			$values=rtrim($values,',');
			$cles=rtrim($cles,',');
		    $sql = "INSERT INTO " .static::$table. " (" .$cles. ") VALUES (".$values.")";
		    $req_prep = Model::$pdo->prepare($sql);
		    $req_prep -> execute($data); 
		}
	
	}
	model::Init();
?>