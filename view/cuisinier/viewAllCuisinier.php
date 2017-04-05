<h1>Liste des cuisiniers</h1>
<?php
foreach ($tab_cuisto as $c) {
?>
<article>
<h1><a href="index.php?controller=cuisinier&amp;action=read&amp;id=<?php echo $c->getId() ?>"><?php echo $c->getNom() . " " . $c->getPrenom() . " | " . $c->getSpecialite() ?></a></h1>
<p>
<?php
?>
</p>
</article>
<?php
}
?>
<i><a href="index.php?controller=cuisinier&amp;action=create&amp;idR=<?php echo $id ?>">Ajouter un cuisinier</a></i>