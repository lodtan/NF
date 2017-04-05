<h1>Liste des serveurs</h1>
<?php
foreach ($tab_serv as $s) {
?>
<article>
<h1><a href="index.php?controller=serveur&amp;action=read&amp;id=<?php echo $s->getId() ?>"> <?php echo $s->getNom() . " " . $s->getPrenom() ?></a></h1>
<p>
<?php
?>
</p>
</article>
<?php
}
?>
<i><a href="index.php?controller=serveur&amp;action=create&amp;idR=<?php echo $id ?>">Ajouter un serveur</a></i>