<?php
require_once ("{$ROOT}{$DS}model{$DS}modelVille.php");
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
        $tab_resto = ModelRestaurant::selectAll();     //appel au modèle pour gerer la BD
        $view="All";
        $pagetitle="Liste des restaurants";
    break;
    case "read":
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $resto = ModelRestaurant::select($id);
            $ville = ModelVille::selectByCPPays($resto->getCodePostal(),$resto->getPays());
            $view="";
            $pagetitle="Page restaurant";
        }
        else {
            $view="error";
            $pagetitle="Restaurant non trouvé";
        }
    break;
    case "create":
        $idR="";
        $n="";
        $a="";
        $cp="";
        $p="";
        $tab_ville=ModelVille::selectAll();
    	$view="update";
        $pagetitle="Ajouter un restaurant";      
    break;
    case "created":
        $n=$_POST['nom'];
        $a=$_POST['adresse'];
        $v=$_POST['ville'];
        list($cp, $p) = split('&', $v);
        $resto = new ModelRestaurant($n, $a, $cp, $p);
        $data = array (
            'nom' => $n,
            'adresse' => $a,
            'codepostal' => $cp,
            'pays' => $p,
        );
        ModelRestaurant::save($data);
        $tab_resto = ModelRestaurant::selectAll();
        $view="allCreated";
        $pagetitle="Liste des restaurants";
    break;
    case "createdVille":
        $cp=$_POST['codepostal'];
        $p=$_POST['pays'];
        $n=$_POST['nom'];
        $ville = new ModelVille($cp, $p, $n);
        $data = array (
            'codepostal' => $cp,
            'pays' => $p,
            'nom' => $n,
        );
        ModelVille::save($data);
    case "update":
        $action="update";
        $idR=$_POST['id'];
        if ($idR!=-1) {
            $resto=ModelRestaurant::select($idR);
            $n=$resto->getNom();
            $a=$resto->getAdresse();
            $cp=$resto->getCodePostal();
            $p=$resto->getPays();
            $tab_ville=ModelVille::selectAll();
            $view="update";
            $pagetitle="Modifier un restaurant";
        }
        else {
            $action="create";
            $idR="";
            $n="";
            $a="";
            $cp="";
            $p="";
            $tab_ville=ModelVille::selectAll();
            $view="update";
            $pagetitle="Ajouter un restaurant"; 
        }
    break;
    case "updated":
        $id=$_POST['id'];
        $n=$_POST['nom'];
        $a=$_POST['adresse'];
        $v=$_POST['ville'];
        list($cp, $p) = split('&', $v);
        $data = array (
              'id' => $id,
              'nom' => $n,
              'adresse' => $a,
              'codepostal' => $cp,
              'pays' => $p,
        );
        ModelRestaurant::update($data);

        $tab_resto=ModelRestaurant::selectAll();
        $view="allUpdated";
        $pagetitle="Liste des restaurants";
    break;
    case "delete":
        $id=$_POST['id'];
        // Pour la vue deleted, on sélectionne le nom du restaurant supprimé
        $r=ModelRestaurant::select($id);
        $name=$r->getNom();
        ModelRestaurant::deleteAllidResto("Cuisinier", $id);
        ModelRestaurant::deleteAllidResto("Serveur", $id);
        ModelRestaurant::deleteAllidResto("Manager", $id);
        ModelRestaurant::deleteAllidResto("Periode", $id);
        ModelRestaurant::delete($id);
        $tab_resto = ModelRestaurant::selectAll();

        $view="allDeleted";
        $pagetitle="Liste des restaurants";
    break;
    case "createVille":
        $cp="";
        $p="";
        $n="";
        $view="createVille";
        $pagetitle="Ajouter une ville";

}
require "{$ROOT}{$DS}view{$DS}view.php";
?>