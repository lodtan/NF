<?php
require_once ("{$ROOT}{$DS}model{$DS}modelServeur.php");
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
        $tab_serv = ModelServeur::selectAll();     //appel au modèle pour gerer la BD
        $view="All";
        $pagetitle="Liste des serveurs";
    break;
    case "read":
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $serv = ModelServeur::select($id);
            $resto = ModelRestaurant::select($serv->getIdResto());
            list($y, $m, $d) = split('-', $serv->getAnciennete());
            $ancyear = date('Y',time())-$y;
            $ancmonth = date('m',time())-$m;
            if ($ancmonth<0) {
                $ancyear--;
                $ancmonth=12-abs($ancmonth);
            }
            $view="";
            $pagetitle="Profil serveur";
        }
        else {
            $view="error";
            $pagetitle="Serveur non trouvé";
        }
    break;
    case "readServeurs":
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $tab_serv = ModelServeur::selectByResto($id);
            $view="All";
            $pagetitle="Liste des serveurs";
        }
        else {
            $view="error";
            $pagetitle="Serveurs non trouvés";
        }
    break;
    case "delete":
        $idS=$_POST['idS'];
        $id=$_POST['idR'];
        // Pour la vue deleted, on sélectionne le nom du serveur supprimé
        $m=ModelServeur::select($idS);
        $name=$m->getNom();
            
        ModelServeur::delete($idS);
        $tab_serv = ModelServeur::selectByResto($id);

        $view="allDeleted";
        $pagetitle="Liste des serveurs";
    break;
    case "create":
        if (isset($_GET['idR'])) {
            $idR=$_GET['idR'];
            $idS="";
            $n="";
            $p="";
            $dn="";
            $a="";
            $acc="";
            $view="update";
            $pagetitle="Ajouter un serveur";
        }
        else {
            $view="error";
            $pagetitle="serveur non trouvé";
        }      
    break;
    case "created":
        $n=$_POST['nom'];
        $p=$_POST['prenom'];
        $dn=$_POST['datenaiss'];
        $a=$_POST['anciennete'];
        if (isset($_POST['accueil']) && $_POST['accueil']!="") {
            $acc=$_POST['accueil'];
        }
        else {
            $acc=NULL;
        }
        $id=$_POST['idR'];
        $serv = new ModelServeur($n, $p, $dn, $a, $acc, $id);
        $data = array (
            'nom' => $n,
            'prenom' => $p,
            'datenaiss' => $dn,
            'anciennete' => $a,
            'accueil' => $acc,
            'idresto' => $id,
        );
        ModelServeur::save($data);
        $tab_serv = ModelServeur::selectByResto($id);
        $view="allCreated";
        $pagetitle="Liste des serveurs";
    break;
    case "update":
        $idS=$_POST['idS'];
        $idR=$_POST['idR'];
        $serv=ModelServeur::select($idS);
        $n=$serv->getNom();
        $p=$serv->getPrenom();
        $dn=$serv->getDatenaiss();
        $a=$serv->getAnciennete();
        $acc=$serv->getAccueil();
        $view="update";
        $pagetitle="Modifier un serveur";
    break;
    case "updated":
        $idS=$_POST['idS'];
        $id=$_POST['idR'];
        $n=$_POST['nom'];
        $p=$_POST['prenom'];
        $dn=$_POST['datenaiss'];
        $a=$_POST['anciennete'];
        if (isset($_POST['accueil']) && $_POST['accueil']!="") {
            $acc=$_POST['accueil'];
        }
        else {
            $acc=NULL;
        }
        $data = array (
              'id' => $idS,
              'nom' => $n,
              'prenom' => $p,
              'datenaiss' => $dn,
              'anciennete' => $a,
              'accueil' => $acc,
              'idresto' => $id,
        );
        ModelServeur::update($data);

        $tab_serv = ModelServeur::selectByResto($id);
        $view="allUpdated";
        $pagetitle="Liste des serveurs";
}
require "{$ROOT}{$DS}view{$DS}view.php";
?>