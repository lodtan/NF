<h1>Contenu du plat</h1>
<?php
while($row = pg_fetch_row($query_contenu)) {
//var_dump($r);
?>
<article>
<h1><?php echo $row[1] . " - " . $row[2] . $row[3] ?></h1>
<p>
<?php
?>
</p>
</article>
<?php
}
?>

<h4><a href="index.php?controller=carte&amp;action=modifierPlat&amp;idcarte=<?php echo $idcarte ?>&amp;id=<?php echo $id/*idplat */?>"> <i><?php echo "Modifier le plat"?></i></a></h4> 