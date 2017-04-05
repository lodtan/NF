<?php
require_once ("{$ROOT}{$DS}model{$DS}modelCarte.php");
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
        //$tab_carte = ModelCarte::selectByPeriod($id);    //appel au modèle pour gerer la BD
        $view="All";
        $pagetitle="Liste des cartes";
    break;
    case "read":
        if (isset($_GET['id'])) { // recupere l'id de la carte courante
            $id=$_GET['id']; 
            $query_menus = ModelCarte::selectMenus($id);
            //$resto = ModelRestaurant::select($carte->getIdResto());
            $query_plats = ModelCarte::selectPlats($id);
            $query_boissons = ModelCarte::selectBoissons($id);
            $view="";
            $pagetitle="Cartes";
        }
        else {
            $view="error";
            $pagetitle="Carte non trouvée";
        }
    break;
    case "readCartes":
        if (isset($_GET['id'])) { // recupere l'id du resto
            $id=$_GET['id'];
            $query_cartes = ModelCarte::selectByPeriod($id);
            $view="All";
            $pagetitle="Liste des cartes";
        }
        else {
            $view="error";
            $pagetitle="Cartes non trouvées";
        }
    break;
    case "readMenu":
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $idcarte = $_GET['idcarte'];;
            $query_contenu = ModelCarte::detailMenu($id);
            $view="Menu";
            $pagetitle="Menu";
        }
        else {
            echo "erreur";
            $view="error";
            $pagetitle="Cartes non trouvées";
        }
    break;
    case "readPlat":
        if (isset($_GET['id'])) { // id du plat
            $id=$_GET['id'];
            if(isset($_GET['idcarte']))
                $idcarte = $_GET['idcarte'];
            else
                $idcarte ="";
            $query_contenu = ModelCarte::detailPlat($id);
            $view="Plat";
            $pagetitle="Menu";
        }
        else {
            $view="error";
            $pagetitle="Cartes non trouvées";
        }
    break;
    case "deletePlat":
        if (isset($_GET['id'])) { // id de la carte
            $id=$_GET['id'];
            $query_plats = ModelCarte::selectPlats($id);
            $view="deletePlat";
            $pagetitle="Supprimer un plat";
        }
        else {
            $view="error";
            $pagetitle="Cartes non trouvées";
        }
    break;
    case "deletedPlat":
        if (isset($_POST['id'])) { // id de la carte
            $id=$_POST['id'];
            $idplat=$_POST['idplat'];
            $query_plats = ModelCarte::supprimerPlat($id, $idplat);
            $view="deletedPlat";
            $pagetitle="Supprimer un plat";
        }
        else {
            $view="error";
            $pagetitle="Cartes non trouvées";
        }
    break;
    case "create":
        $id=$_GET['id'];  // recupere l'id du resto
    	$view="update";
        $pagetitle="Ajouter une carte";      
    break;
    case "selectionMenu": // TODO: menu existant ou nouveau menu
        $id=$_GET['id'];  // recupere l'id de la carte courante
       
    	$view="updateMenu";
        $pagetitle="Ajouter un menu";      
    break;
   case "choixPlats": // 
        $id=$_POST['id'];  // recupere l'id de la carte courante
        $nombre = $_POST['nombre'];
        $nom = $_POST['nom'];
    	$view="choixPlat";
        $pagetitle="Ajouter un menu";      
    break;
    case "addMenuPlat": // 
        $id=$_POST['id'];  // recupere l'id de la carte courante
        $nombre = $_POST['nombre'];
        for ($j= 0; $j < $nombre; $j++){
            $idplats[$j] = $_POST['plat'.$j]; // id plat
          // echo "dans le controller : $idplats[$j] <br>";
        }
        $prix = $_POST['prix'];
        $nom = $_POST['nom'];
        $retour = ModelCarte::ajoutMenuPlat($id, $idplats, $nombre, $prix, $nom);
    	$view="ajoutMenuPlat";
        $pagetitle="Ajouter un menu";      
    break;
    case "createPlat":
        $id=$_GET['id'];  // recupere l'id de la carte courante
        $query_plats = ModelCarte::selectPlatsNonPresent($id);
        $n="";
        $a="";
    	$view="updatePlat";
        $pagetitle="Ajouter un nouveau plat";      
    break;
    case "created":
        $idresto=$_POST['id'];  // id du resto
        $deb=$_POST['datedeb'];
        $fin=$_POST['datefin'];
        ModelCarte::createCarte($deb, $fin, $idresto);
    	$view="allCreated";
        $pagetitle="Carte créée";      
    break;   
        case "selectionPlat":
        $id=$_POST['id'];  // recupere l'id de la carte
        $nom = $_POST['nom'];
        
        if(!isset($_POST['entree']))
            $entree = "false";
        else
            $entree = $_POST['entree'];
            
        if(!isset($_POST['plat']))
            $plat = "false";
        else
            $plat = $_POST['plat'];
            
        if(!isset($_POST['dessert']))
            $dessert = "false";
        else
            $dessert = $_POST['dessert'];
            
        $nombre = $_POST['nombre'];
        $prix = $_POST['prix'];
        $categorie = $_POST['cate'];
        //echo $nombre;
        //echo "test";
    	$view="ajoutPlat";
        $pagetitle="Ajouter des ingrédients pour le plat";      
    break;
    case "addIngredientPlat":
        $nombre = $_POST['nombre'];
        //echo $nombre;
        if($nombre>0){
        $id=$_POST['id'];  // recupere l'id de la carte
        $nom = $_POST['nom'];
        $entree = $_POST['entree'];
        $plat = $_POST['plat'];
        $dessert = $_POST['dessert'];
        $categorie = $_POST['categorie'];
        $idplat = ModelCarte::addPlat($nom, $entree, $plat, $dessert, $categorie, $prix, $id); // doit retourner l'id du plat qu'on vient d'ajouter
        
         for ($j= 0; $j < $nombre; $j++){
            $ingredient[$j] = $_POST['ingredient'.$j];
            $mesure[$j] = $_POST['mesure'.$j];
            $quantite[$j] = $_POST['quantite'.$j];
            //echo $ingredient[$j] ;
            //echo $quantite[$j];
            //echo $mesure[$j];
         }
        $retour = ModelCarte::addIngredientPlat($idplat, $ingredient, $quantite, $mesure, $nombre);
    	$view="ajoutIngredientPlatSucces";
        $pagetitle="";  
        }
    break;
    case "ajoutPlatExistant":
        $id=$_POST['id'];  // recupere l'id de la carte
        $idplat = $_POST['idplat'];
        $prix = $_POST['prix'];
        $retour = ModelCarte::ajoutPlatExistant($id, $idplat, $prix);
    	$view="ajoutPlatExistantSucces";
        $pagetitle="";      
    break;
        case "modifierPlat":
        $id=$_GET['id'];  // recupere l'id du plat
        $idcarte=$_GET['idcarte'];
        //$retour = ModelCarte::ajoutPlatExistant($id, $idplat, $prix);
    	$view="modifierPlat";
        $pagetitle="";      
    break;
    case "updatePlat":
        $id=$_POST['id'];  // recupere l'id du plat
        $idcarte=$_POST['idcarte'];
        $nom = $_POST['nom'];
        
        if(!isset($_POST['entree']))
            $entree = "false";
        else
            $entree = $_POST['entree'];
            
        if(!isset($_POST['plat']))
            $plat = "false";
        else
            $plat = $_POST['plat'];
            
        if(!isset($_POST['dessert']))
            $dessert = "false";
        else
            $dessert = $_POST['dessert'];
            
        //$nombre = $_POST['nombre'];
        $prix = $_POST['prix'];
        $cate = $_POST['cate'];

        ModelCarte::updatePlat($id, $nom, $entree, $plat, $dessert, $idcarte, $prix, $cate);
        
        $view="modifIngredientPlat";
        break;

    
}
require "{$ROOT}{$DS}view{$DS}view.php";
?>