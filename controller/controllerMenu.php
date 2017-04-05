<?php
require_once ("{$ROOT}{$DS}model{$DS}modelMenu.php");
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
        $tab_cuisto = ModelCuisinier::selectAll();     //appel au modèle pour gerer la BD
        $view="All";
        $pagetitle="Liste des menus";
    break;
    case "read":
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $cuisto = ModelCuisinier::select($id);
            $resto = ModelRestaurant::select($cuisto->getIdResto());
            $view="";
            $pagetitle="Menus à la carte";
        }
        else {
            $view="error";
            $pagetitle="menu non trouvé";
        }
    break;
    case "readCuistos":
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $tab_cuisto = ModelCuisinier::selectByResto($id);
            $view="All";
            $pagetitle="Liste des cuisiniers";
        }
        else {
            $view="error";
            $pagetitle="Cuisiniers non trouvés";
        }
    break;
    case "create":
        $id="";
        $n="";
        $a="";
    	$view="update";
        $pagetitle="Ajouter un cuisinier";      
    break;
}
require "{$ROOT}{$DS}view{$DS}view.php";
?>