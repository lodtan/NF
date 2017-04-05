<h1>Liste des restaurants</h1>
<?php
foreach ($tab_resto as $r) {
?>
<article>
<h1><a href="index.php?controller=restaurant&amp;action=read&amp;id=<?php echo $r->getId() ?>"><?php echo $r->getNom() ?></a></h1>
<p>
<?php
?>
</p>
</article>
<?php
}
?>
<i><a href="index.php?controller=restaurant&amp;action=create">Ajouter un restaurant</a></i>