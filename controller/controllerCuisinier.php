<?php
require_once ("{$ROOT}{$DS}model{$DS}modelCuisinier.php");
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
        $tab_cuisto = ModelCuisinier::selectAll();     //appel au modèle pour gerer la BD
        $view="All";
        $pagetitle="Liste des cuisiniers";
    break;
    case "read":
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $cuisto = ModelCuisinier::select($id);
            $resto = ModelRestaurant::select($cuisto->getIdResto());
            list($y, $m, $d) = split('-', $cuisto->getAnciennete());
            $ancyear = date('Y',time())-$y;
            $ancmonth = date('m',time())-$m;
            if ($ancmonth<0) {
                $ancyear--;
                $ancmonth=12-abs($ancmonth);
            }
            $view="";
            $pagetitle="Profil cuisinier";
        }
        else {
            $view="error";
            $pagetitle="Cuisinier non trouvé";
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
    case "delete":
        $idC=$_POST['idC'];
        $id=$_POST['idR'];
        // Pour la vue deleted, on sélectionne le nom du cuisinier supprimé
        $m=ModelCuisinier::select($idC);
        $name=$m->getNom();
            
        ModelCuisinier::delete($idC);
        $tab_cuisto = ModelCuisinier::selectByResto($id);

        $view="allDeleted";
        $pagetitle="Liste des cuisiniers";
    break;
    case "create":
        if (isset($_GET['idR'])) {
            $idR=$_GET['idR'];
            $idC="";
            $n="";
            $p="";
            $dn="";
            $a="";
            $s="";
            $view="update";
            $pagetitle="Ajouter un cuisinier";
        }
        else {
            $view="error";
            $pagetitle="cuisinier non trouvé";
        }      
    break;
    case "created":
        $n=$_POST['nom'];
        $p=$_POST['prenom'];
        $dn=$_POST['datenaiss'];
        $a=$_POST['anciennete'];
        $s=$_POST['specialite'];
        if ($s=="") {
            $s=NULL;
        }
        $id=$_POST['idR'];
        $cuisto = new ModelCuisinier($n, $p, $dn, $a, $s, $id);
        $data = array (
            'nom' => $n,
            'prenom' => $p,
            'datenaiss' => $dn,
            'anciennete' => $a,
            'specialite' => $s,
            'idresto' => $id,
        );
        ModelCuisinier::save($data);
        $tab_cuisto = ModelCuisinier::selectByResto($id);
        $view="allCreated";
        $pagetitle="Liste des cuisiniers";
    break;
    case "update":
        $idC=$_POST['idC'];
        $idR=$_POST['idR'];
        $cuisto=ModelCuisinier::select($idC);
        $n=$cuisto->getNom();
        $p=$cuisto->getPrenom();
        $dn=$cuisto->getDatenaiss();
        $a=$cuisto->getAnciennete();
        $s=$cuisto->getSpecialite();
        $view="update";
        $pagetitle="Modifier un cuisinier";
    break;
    case "updated":
        $idC=$_POST['idC'];
        $id=$_POST['idR'];
        $n=$_POST['nom'];
        $p=$_POST['prenom'];
        $dn=$_POST['datenaiss'];
        $a=$_POST['anciennete'];
        $s=$_POST['specialite'];
        if ($s=="") {
            $s=NULL;
        }
        $data = array (
              'id' => $idC,
              'nom' => $n,
              'prenom' => $p,
              'datenaiss' => $dn,
              'anciennete' => $a,
              'specialite' => $s,
              'idresto' => $id,
        );
        ModelCuisinier::update($data);

        $tab_cuisto = ModelCuisinier::selectByResto($id);
        $view="allUpdated";
        $pagetitle="Liste des cuisiniers";
}
require "{$ROOT}{$DS}view{$DS}view.php";
?>