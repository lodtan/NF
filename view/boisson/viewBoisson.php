<h1><?php echo $cuisto->getNom() . " " . $cuisto->getPrenom() ?></h1>
<p>
Spécialité : <?php echo $cuisto->getSpecialite() ?>
<br/>
Date de naissance : <?php echo $cuisto->getDatenaiss() ?>
<br/>
Ancienneté : <?php echo $cuisto->getAnciennete() ?>
<br/>
<b>Travaille au :</b> <a href="index.php?controller=restaurant&amp;action=read&amp;id=<?php echo $resto->getId() ?>"><?php echo $resto->getNom() ?></a>
</p>