<h1><?php echo $serv->getNom() . " " . $serv->getPrenom() ?></h1>
<p>
Date de naissance : <?php echo $serv->getDatenaiss() ?>
<br/>
Ancienneté : <?php echo $ancyear . ' an(s) et ' . $ancmonth . ' mois' ?> (<?php echo $serv->getAnciennete() ?>)
<br/>
Accès accueil : <?php if ($serv->getAccueil()=='true') { echo 'Oui'; } else { echo 'Non'; } ?>
<br/>
<b>Travaille au :</b> <a href="index.php?controller=restaurant&amp;action=read&amp;id=<?php echo $resto->getId() ?>"><?php echo $resto->getNom() ?></a>
</p>

<p>
	<form method="post" action="index.php">
	   	<input type="hidden" name="controller" value="serveur">
   		<input type="hidden" name="action" value="update">
   		<input type="hidden" name="idS" value=<?php echo $serv->getId() ?>>
   		<input type="hidden" name="idR" value=<?php echo $resto->getId() ?>>
		<input type="submit" value="Modifier le serveur" />
	</form>
</p>

<p>
	<form method="post" action="index.php">
	   	<input type="hidden" name="controller" value="serveur">
   		<input type="hidden" name="action" value="delete">
   		<input type="hidden" name="idS" value=<?php echo $serv->getId() ?>>
   		<input type="hidden" name="idR" value=<?php echo $resto->getId() ?>>
		<input type="submit" value="Supprimer le serveur" />
	</form>
</p>