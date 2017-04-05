<form method="post" action="index.php">
		<fieldset>
	<legend><b><?php echo "Ajouter les volumes disponibles pour une boisson" ?></b></legend>
        <p>
  		<label for="nom_id">Nom</label> :
  		<select name="boisson" size="1">
                <?php
                while ($row = pg_fetch_row($query_boisson)) {
                ?>
                <option value="<?php echo $row[0]?>" selected><?php echo $row[1] . " - " . $row[2] ." dl" ?></option>
                <?php
                }
        
                ?>
                </select>
	</p>
        <p>
  		 </p> <p>
  		     <label for="prix_id"> Prix : </label>
                        <input type="number" name="prix" step="any">
	</p>

  <input type="hidden" name="controller" value="boisson">
  <input type="hidden" name="action" value="addBoissonCarte">
  <input type="hidden" name="id" value=<?php echo $id  /* id carte */ ?>> 

  <p>
  		<input type="submit" value="Envoyer" />
	</p>
		</fieldset> 
</form>