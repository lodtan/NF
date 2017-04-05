<?php
require_once ("{$ROOT}{$DS}model{$DS}modelManager.php");
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

date_default_timezone_set('Europe/Paris');

switch ($action) {
    case "readAll":
        $tab_man = ModelManager::selectAll();     //appel au modèle pour gerer la BD
        $view="All";
        $pagetitle="Liste des managers";
    break;
    case "read":
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $man = ModelManager::select($id);
            $resto = ModelRestaurant::select($man->getIdResto());
            list($y, $m, $d) = split('-', $man->getAnciennete());
            $ancyear = date('Y',time())-$y;
            $ancmonth = date('m',time())-$m;
            if ($ancmonth<0) {
                $ancyear--;
                $ancmonth=12-abs($ancmonth);
            }
            $view="";
            $pagetitle="Profil manager";
        }
        else {
            $view="error";
            $pagetitle="Manager non trouvé";
        }
    break;
    case "readManagers":
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $tab_man = ModelManager::selectByResto($id);
            $view="All";
            $pagetitle="Liste des managers";
        }
        else {
            $view="error";
            $pagetitle="Managers non trouvés";
        }
    break;
    case "delete":
        $idM=$_POST['idM'];
        $id=$_POST['idR'];
        // Pour la vue deleted, on sélectionne le nom du manager supprimé
        $m=ModelManager::select($idM);
        $name=$m->getNom();
            
        ModelManager::delete($idM);
        $tab_man = ModelManager::selectByResto($id);

        $view="allDeleted";
        $pagetitle="Liste des managers";
    break;
    case "create":
        if (isset($_GET['idR'])) {
            $idR=$_GET['idR'];
            $idM="";
            $n="";
            $p="";
            $dn="";
            $a="";
        	$view="update";
            $pagetitle="Ajouter un manager";
        }
        else {
            $view="error";
            $pagetitle="Manager non trouvé";
        }      
    break;
    case "created":
        $n=$_POST['nom'];
        $p=$_POST['prenom'];
        $dn=$_POST['datenaiss'];
        $a=$_POST['anciennete'];
        $id=$_POST['idR'];
        $man = new ModelManager($n, $p, $dn, $a, $id);
        $data = array (
            'nom' => $n,
            'prenom' => $p,
            'datenaiss' => $dn,
            'anciennete' => $a,
            'idresto' => $id,
        );
        ModelManager::save($data);
        $tab_man = ModelManager::selectByResto($id);
        $view="allCreated";
        $pagetitle="Liste des managers";
    break;
    case "update":
        $idM=$_POST['idM'];
        $idR=$_POST['idR'];
        $man=ModelManager::select($idM);
        $n=$man->getNom();
        $p=$man->getPrenom();
        $dn=$man->getDatenaiss();
        $a=$man->getAnciennete();
        $view="update";
        $pagetitle="Modifier un manager";
    break;
    case "updated":
        $idM=$_POST['idM'];
        $id=$_POST['idR'];
        $n=$_POST['nom'];
        $p=$_POST['prenom'];
        $dn=$_POST['datenaiss'];
        $a=$_POST['anciennete'];
        $data = array (
              'id' => $idM,
              'nom' => $n,
              'prenom' => $p,
              'datenaiss' => $dn,
              'anciennete' => $a,
              'idresto' => $id,
        );
        ModelManager::update($data);

        $tab_man = ModelManager::selectByResto($id);
        $view="allUpdated";
        $pagetitle="Liste des managers";
    break;
}
require "{$ROOT}{$DS}view{$DS}view.php";
?>