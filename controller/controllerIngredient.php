 <?php
require_once ("{$ROOT}{$DS}model{$DS}modelIngredient.php");
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
        $query_ingredient = ModelIngredient::selectAllIngredient();
        $view="All";
        $pagetitle="Liste des ingrédients";
    break;
    case "create":
        $id="";
        $n="";
        $a="";
    	$view="update";
        $pagetitle="Ajouter un ingrédient";      
    break;
    case "created":
        $nom= $_POST['nom'];
        $createIngredient = ModelIngredient::addIngredient($nom);
    	$view="updated";
        $pagetitle="Ajout de l'ingrédient effectué avec succès";      
    break;
}
require "{$ROOT}{$DS}view{$DS}view.php";
?>
