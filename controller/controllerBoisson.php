<?php
require_once ("{$ROOT}{$DS}model{$DS}modelBoisson.php");
require_once ("{$ROOT}{$DS}model{$DS}modelRestaurant.php");
if (isset($_GET['action'])) {
   $action=$_GET['action'];
}
elseif (isset($_POST['action'])) {
    $action=$_POST['action'];
}
else {
   $action="readAll";
}


switch ($action) {
    case "readAll":
        $query_boissons = ModelBoisson::selectAllBoissons();
        $view="All";
        $pagetitle="Liste des cuisiniers";
    break;
    case "read":
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $cuisto = ModelCuisinier::select($id);
            $resto = ModelRestaurant::select($cuisto->getIdResto());
            $view="";
            $pagetitle="Profil cuisinier";
        }
        else {
            $view="error";
            $pagetitle="Cuisinier non trouvé";
        }
    break;
    case "readBoissons":
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $query_boissons = ModelCuisinier::selectAllBoissons($id);
            $view="All";
            $pagetitle="Liste des boissons";
        }
        else {
            $view="error";
            $pagetitle="Cuisiniers non trouvés";
        }
    break;
    case "create":
        
        $query_boissons = ModelBoisson::selectAllBoissons();
    	$view="update";
        $pagetitle="Ajouter une boisson";      
    break;
    case "addBoisson":
        //$id=$_POST['id'];  // recupere l'id de la carte courante
        $nom=$_POST['nom'];
        $annee = $_POST['annee'];
        $query_boisson = ModelBoisson::addBoisson($nom, $annee);
    	$view="updated";
        $pagetitle="Ajouter une boisson";       
    break;
      case "addBoissonVendue":
       // $id=$_POST['id'];  // recupere l'id de la carte courante
        $nom = $_POST['boisson'];
        $volume = $_POST['volume'];

        $query_boisson = ModelBoisson::addBoissonVendue($volume, $nom);
    	$view="updated";
        $pagetitle="Ajouter une boisson";       
    break;
    case "createBoissonCarte":
        $id=$_GET['id'];  // recupere l'id de la carte courante
        $query_boisson = ModelBoisson::selectBoissonsNonPresent($id);
    	$view="updateCarte";
        $pagetitle="Ajouter une boisson";       
    break;
        case "addBoissonCarte":
        $idboisson = $_POST['boisson'];
        $idcarte = $_POST['id'];
        $prix = $_POST['prix'];
        $result = ModelBoisson::addBoissoncarte($idcarte, $idboisson, $prix);
        $view="updated";
    break;
    case "deleteBoissonCarte":
        $idcarte = $_GET['id'];
        $query_boissons = ModelBoisson::selectBoissonsPresentes($idcarte);
        $view="deleteCarte";
    break;
       case "deletedBoissonCarte":
        $idcarte = $_POST['id'];
        $idboisson = $_POST['idboisson'];
        $retour = ModelBoisson::supprimerBoissonCarte($idcarte, $idboisson);
        $view="deletedCarte";
    break;
    
    
    
}
require "{$ROOT}{$DS}view{$DS}view.php";
?>