<h1><?php echo $cuisto->getNom() . " " . $cuisto->getPrenom() ?></h1>
<p>
Spécialité : <?php echo $cuisto->getSpecialite() ?>
<br/>
Date de naissance : <?php echo $cuisto->getDatenaiss() ?>
<br/>
Ancienneté : <?php echo $ancyear . ' an(s) et ' . $ancmonth . ' mois' ?> (<?php echo $cuisto->getAnciennete() ?>)
<br/>
<b>Travaille au :</b> <a href="index.php?controller=restaurant&amp;action=read&amp;id=<?php echo $resto->getId() ?>"><?php echo $resto->getNom() ?></a>
</p>

<p>
	<form method="post" action="index.php">
	   	<input type="hidden" name="controller" value="cuisinier">
   		<input type="hidden" name="action" value="update">
   		<input type="hidden" name="idC" value=<?php echo $cuisto->getId() ?>>
   		<input type="hidden" name="idR" value=<?php echo $resto->getId() ?>>
		<input type="submit" value="Modifier le cuisinier" />
	</form>
</p>

<p>
	<form method="post" action="index.php">
	   	<input type="hidden" name="controller" value="cuisinier">
   		<input type="hidden" name="action" value="delete">
   		<input type="hidden" name="idC" value=<?php echo $cuisto->getId() ?>>
   		<input type="hidden" name="idR" value=<?php echo $resto->getId() ?>>
		<input type="submit" value="Supprimer le cuisinier" />
	</form>
</p>