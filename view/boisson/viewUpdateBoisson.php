 
<form method="post" action="index.php">
		<fieldset>
	<legend><b><?php echo "Ajouter à l'annuaire des boissons" ?></b></legend>
        <p>
  		<label for="nom_id">Nom</label> :
  		<input type="text" name="nom" id="nom_id" required/><br>
                <label for="volume_id">Année(0 si pas d'année)</label> :
  		<input type="text" name="annee" id="annee_id" required/>
	</p>
  <input type="hidden" name="controller" value="boisson">
  <input type="hidden" name="action" value="addBoisson">
  
  

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
                while ($row = pg_fetch_row($query_boissons)) {
                ?>
                <option value="<?php echo $row[0]?>" selected><?php echo $row[0] ?></option>
                <?php
                }
        
                ?>
                </select>
	</p>
        <p>
  		<label for="volume_id">Volume (en dl) </label> :
  		<input type="text" name="volume" id="volume_id" required/>
  		 </p> <p>

	</p>

  <input type="hidden" name="controller" value="boisson">
  <input type="hidden" name="action" value="addBoissonVendue">
  

  <p>
  		<input type="submit" value="Envoyer" />
	</p>
		</fieldset> 
</form>