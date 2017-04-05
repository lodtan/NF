<?php
require_once ("{$ROOT}{$DS}model{$DS}modelCommande.php");
require_once ("{$ROOT}{$DS}model{$DS}modelRestaurant.php");
require_once ("{$ROOT}{$DS}model{$DS}modelMenu.php");
require_once ("{$ROOT}{$DS}model{$DS}modelCarte.php");
require_once ("{$ROOT}{$DS}model{$DS}modelBoisson.php");
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
        $tab_commande = ModelCommande::selectAll();     //appel au modèle pour gerer la BD
        $view="All";
        $pagetitle="Liste des commandes";
    break;
    case "read":
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $c = ModelCommande::select($id);
            $resto = ModelRestaurant::select($c->getIdResto());
            $menus = ModelCommande::selectCommandes("Menu", $id);
            $plats = ModelCommande::selectCommandes("Plat", $id);
            $boissons = ModelCommande::selectCommandes("Boisson", $id);
            $view="";
            $pagetitle="Page commande";
        }
        else {
            $view="error";
            $pagetitle="Commande non trouvée";
        }
    break;
}
require "{$ROOT}{$DS}view{$DS}view.php";
?>