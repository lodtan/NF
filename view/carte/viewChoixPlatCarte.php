<h1>Ajout des plats au menu</h1>


<form method="post" action="index.php">
		<fieldset>
<?php

for ($i= 0; $i < $nombre; $i++) {
//var_dump($r);
?>

                <select name="plat<?php echo $i ?>" size="1">
                <?php
                $sql = "SELECT id,nom FROM plat;";// SELECT idmenu, prix, nom
      
                $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
                $query_plat = pg_query($conn, $sql);
                
                
                 while($j = pg_fetch_row($query_plat)){
                ?>
                <option value="<?php echo $j[0] ?>" selected><?php echo $j[1]?></option>
                <?php
                }
        
                ?>
                </select> <br>
<?php 
}
?>
    <label for="prix_id"> Prix : </label>
    <input type="number" name="prix" step="any" required>

  <input type="hidden" name="controller" value="carte">
  <input type="hidden" name="action" value="addMenuPlat"> <?php /* a verifier addMenuPlat */ ?>
    <input type="hidden" name="nombre" value=<?php echo $nombre ?>>
    <input type="hidden" name="nom" value=<?php echo $nom ?>>
  <?php /* <input type="hidden" name="idplat" value=<?php echo $idplat ?>> */ ?>
  <input type="hidden" name="id" value="<?php echo $id  /* id carte */ ?>">
  
  <input type="submit" value="Envoyer" />
		</fieldset> 
</form>