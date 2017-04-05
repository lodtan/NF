<h1><?php echo $man->getNom() . " " . $man->getPrenom() ?></h1>
<p>
Date de naissance : <?php echo $man->getDatenaiss() ?>
<br/>
Ancienneté : <?php echo $ancyear . ' an(s) et ' . $ancmonth . ' mois' ?> (<?php echo $man->getAnciennete() ?>)
<br/>
<b>Travaille au :</b> <a href="index.php?controller=restaurant&amp;action=read&amp;id=<?php echo $resto->getId() ?>"><?php echo $resto->getNom() ?></a>
</p>

<p>
	<form method="post" action="index.php">
	   	<input type="hidden" name="controller" value="manager">
   		<input type="hidden" name="action" value="update">
   		<input type="hidden" name="idM" value=<?php echo $man->getId() ?>>
   		<input type="hidden" name="idR" value=<?php echo $resto->getId() ?>>
		<input type="submit" value="Modifier le manager" />
	</form>
</p>

<p>
	<form method="post" action="index.php">
	   	<input type="hidden" name="controller" value="manager">
   		<input type="hidden" name="action" value="delete">
   		<input type="hidden" name="idM" value=<?php echo $man->getId() ?>>
   		<input type="hidden" name="idR" value=<?php echo $resto->getId() ?>>
		<input type="submit" value="Supprimer le manager" />
	</form>
</p>