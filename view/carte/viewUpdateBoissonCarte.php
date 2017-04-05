<form method="post" action="index.php">
		<fieldset>
	<legend><b><?php echo "Ajouter à l'annuaire des boissons" ?></b></legend>
        <p>
  		<label for="nom_id">Nom</label> :
  		<input type="text" name="nom" id="nom_id" required/>
	</p>

  <input type="hidden" name="action" value="addBoisson">
  <input type="hidden" name="id" value=<?php echo $id  /* id carte */ ?>> 

  <p>
  		<input type="submit" value="Envoyer" />
	</p>
		</fieldset> 
</form>

<form method="post" action="index.php">
		<fieldset>
	<legend><b><?php echo "Ajouter les volumes disponibles pour une boisson" ?></b></legend>
        <p>
  		<label for="nom_id">Nom</label> :
  		<select name="boisson" size="1">
                <?php
                while ($row = pg_fetch_row($query_boisson)) {
                ?>
                <option value="<?php echo $row[0]?>" selected><?php echo $row[0] ?></option>
                <?php
                }
        
                ?>
                </select>
	</p>
        <p>
  		<label for="volume_id">Volume</label> :
  		<input type="text" name="volume" id="volume_id" required/>
  		 </p> <p>
  		<label for="volume_id">Année(0 si pas d'année)</label> :
  		<input type="text" name="anne" id="annee_id" required/>
	</p>

  <input type="hidden" name="controller" value="carte">
  <input type="hidden" name="action" value="addBoissonVendue">
  <input type="hidden" name="id" value=<?php echo $id  /* id carte */ ?>> 

  <p>
  		<input type="submit" value="Envoyer" />
	</p>
		</fieldset> 
</form>