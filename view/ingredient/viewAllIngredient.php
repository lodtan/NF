<h1><?php echo $pagetitle ?> </h1>
<?php
while($row = pg_fetch_row($query_ingredient)) {
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
<h3><a href="index.php?controller=ingredient&amp;action=create&amp;id=0"> <?php echo "Ajouter un ingrédient"?></a></h3> 