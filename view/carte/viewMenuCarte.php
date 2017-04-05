<h1>Contenu du menu</h1>
<?php
while($row = pg_fetch_row($query_contenu)) {
//var_dump($r);
?>
<article>
<h1><a href="index.php?controller=carte&amp;action=readPlat&amp;idcarte=<?php echo $idcarte ?>&amp;id=<?php echo $row[0] /* idplat */ ?>"><?php echo $row[1]  ?></h1>
<p>
<?php
?>
</p>
</article>
<?php
}
?>