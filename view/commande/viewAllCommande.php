<h1>Liste des commandes</h1>
<?php
foreach ($tab_commande as $c) {
	$resto = ModelRestaurant::select($c->getIdResto());
?>
<article>
<h1><a href="index.php?controller=commande&amp;action=read&amp;id=<?php echo $c->getId() ?>"><?php echo $c->getId() . " | " . $c->getDate() . " | " . $resto->getNom() ?></a></h1>
<p>
<?php
?>
</p>
</article>
<?php
}
?>
<!--<i><a href="index.php?controller=restaurant&amp;action=create">Ajouter un restaurant</a></i>-->