<h1><?php echo "Commande n°" . $id . " - " . $resto->getNom() ?></h1>
<p>
Date de la commande : <?php echo $c->getDate() ?>
<br/>
<h2>Menus</h2>
<?php 
foreach($menus as $m) {
	$mm=ModelMenu::select($m[1]);
	echo $mm->getNom() . " - Quantité : ". $m[2] . "<br/>";
}
?>
<h2>Plats</h2>
<?php 
foreach($plats as $p) {
        $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
        $sql = "SELECT nom FROM plat WHERE id=$p[1]";
        $requete = pg_query($conn, $sql);
        $retour = pg_fetch_row($requete);
	echo $retour[0] . " - Quantité : ". $p[2] . "<br/>";
}
?>
<h2>Boissons</h2>
<?php 
foreach($boissons as $b) {
        // $b[1] == idboisson
        $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
        $sql = "SELECT nom,volume FROM boissonvendue WHERE id=$b[1]";
        $requete = pg_query($conn, $sql);
        $retour = pg_fetch_row($requete);
	echo "$retour[0] - $retour[1] dl  - Quantité :  $b[2] <br/>";

}
?>
</p>
