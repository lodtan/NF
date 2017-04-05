<h1>Liste des managers</h1>
<?php
foreach ($tab_man as $m) {
?>
<article>
<h1><a href="index.php?controller=manager&amp;action=read&amp;id=<?php echo $m->getId() ?>"><?php echo $m->getNom() . " " . $m->getPrenom() ?></a></h1>
<p>
<?php
?>
</p>
</article>
<?php
}
?>
<i><a href="index.php?controller=manager&amp;action=create&amp;idR=<?php echo $id ?>">Ajouter un manager</a></i>