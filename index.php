<?php
	$ROOT = __DIR__;
	$DS = DIRECTORY_SEPARATOR;
	if (isset($_GET['controller'])) {
		$controller=$_GET['controller'];
	}
	elseif (isset($_POST['controller'])) {
		$controller=$_POST['controller'];
	}
	else {
		$controller="restaurant";
	}
	switch ($controller) {
		case "restaurant":
			require("controller{$DS}controllerRestaurant.php");
		break;
		case "manager":
			require("controller{$DS}controllerManager.php");
		break;
		case "cuisinier":
			require("controller{$DS}controllerCuisinier.php");
		break;
		case "serveur":
			require("controller{$DS}controllerServeur.php");
		break;
		case "carte":
			require("controller{$DS}controllerCarte.php");
		break;
		case "ingredient":
			require("controller{$DS}controllerIngredient.php");
		break;
        case "boisson":
			require("controller{$DS}controllerBoisson.php");
		break;
	    case "commande":
			require("controller{$DS}controllerCommande.php");
		break;
	}
?>