<h1>Liste des Boisson</h1>

<?php
while($row = pg_fetch_row($query_boissons)) {
//var_dump($r);
?>
<article>
<h2> <i> <?php echo $row[0]  ?> </i></h2> 
<p>
<?php
?>
</p>
</article>
<?php
}
?>
<h3><a href="index.php?controller=boisson&amp;action=create&amp;id=0"> <?php echo "Ajouter une boisson"?></a></h3> 