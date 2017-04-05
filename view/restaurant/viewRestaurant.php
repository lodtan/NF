<h1><?php echo $resto->getNom() ?></h1>
<p>
<?php echo $resto->getAdresse() ?>
<br/>
<?php echo $resto->getCodePostal() . " " . $ville->getNom() ?>
<br/>
<?php echo $resto->getPays() ?>
</p>
<h2><a href="index.php?controller=manager&amp;action=readManagers&amp;id=<?php echo $resto->getId() ?>">Managers</a></h2>
<h2><a href="index.php?controller=cuisinier&amp;action=readCuistos&amp;id=<?php echo $resto->getId() ?>">Cuisiniers</a></h2>
<h2><a href="index.php?controller=serveur&amp;action=readServeurs&amp;id=<?php echo $resto->getId() ?>">Serveurs</a></h2>
<h2><a href="index.php?controller=carte&amp;action=readCartes&amp;id=<?php echo $resto->getId() ?>">Cartes</a></h2>

<p>
	<form method="post" action="index.php">
	   	<input type="hidden" name="controller" value="restaurant">
   		<input type="hidden" name="action" value="update">
   		<input type="hidden" name="id" value=<?php echo $resto->getId() ?>>
		<input type="submit" value="Modifier le restaurant" />
	</form>
</p>

<p>
	<form method="post" action="index.php">
	   	<input type="hidden" name="controller" value="restaurant">
   		<input type="hidden" name="action" value="delete">
   		<input type="hidden" name="id" value=<?php echo $resto->getId() ?>>
		<input type="submit" value="Supprimer le restaurant" />
	</form>
</p>