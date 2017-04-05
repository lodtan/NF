<h1>Liste des cartes</h1>
<?php
while($row = pg_fetch_row($query_cartes)) {
//var_dump($r);
?>
<article>
<h1><a href="index.php?controller=carte&amp;action=read&amp;id=<?php echo $row[0] /*idcarte */ ?>"> <?php echo $row[2] . "-->" . $row[3]  ?></a></h1> 
<p>
<?php
?>
</p>
</article>
<?php
}
?>
<h3><a href="index.php?controller=carte&amp;action=create&amp;id=<?php echo $id/*idresto */?>"> <?php echo "Ajouter une carte"?></a></h3> 