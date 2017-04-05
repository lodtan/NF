<h1>Menus</h1>
<?php
while($row = pg_fetch_row($query_menus)) {
//var_dump($r);
?>
<article>
<h1><a href="index.php?controller=carte&amp;action=readMenu&amp;idcarte=<?php echo $id?>&amp;id=<?php echo $row[1] ?>"> <?php echo $row[4] . " - " . $row[2] . "€"  ?></a></h1>
<p>
<?php
?>
</p>
</article>
<?php
}
?>
<h4><a href="index.php?controller=carte&amp;action=selectionMenu&amp;id=<?php echo $id/*idcarte */?>"> <i><?php echo "Ajouter un menu"?></i></a></h4> 
<h1>Plats</h1>
<?php
while($row = pg_fetch_row($query_plats)) {
//var_dump($r);
?>
<article>
<h1><a href="index.php?controller=carte&amp;action=readPlat&amp;idcarte=<?php echo $id ?>&amp;id=<?php echo $row[1] /* idplat */ ?>"> <?php echo $row[4] . " - " . $row[2] . "€"  ?></h1>
<p>
<?php
?>
</p>
</article>
<?php
}
?>
<h4><a href="index.php?controller=carte&amp;action=createPlat&amp;id=<?php echo $id/*idcarte */?>"> <i><?php echo "Ajouter un plat"?></i></a></h4> 
<h4><a href="index.php?controller=carte&amp;action=deletePlat&amp;id=<?php echo $id/*idcarte */?>"> <i><?php echo "Supprimer un plat"?></i></a></h4> 
<h1>Boissons</h1>
<?php
while($row = pg_fetch_row($query_boissons)) {
//var_dump($r);
?>
<article>
<h1><?php echo $row[2] . " " . $row[1] . " dl - " .$row[6] . "€"  ?></h1><p>
<?php
?>
</p>
</article>
<?php
}
?>
<h4><a href="index.php?controller=boisson&amp;action=createBoissonCarte&amp;id=<?php echo $id/*idcarte */?>"> <i><?php echo "Ajouter une boisson"?></i></a></h4> 
<h4><a href="index.php?controller=boisson&amp;action=deleteBoissonCarte&amp;id=<?php echo $id/*idcarte */?>"> <i><?php echo "Supprimer  une boisson"?></i></a></h4> 