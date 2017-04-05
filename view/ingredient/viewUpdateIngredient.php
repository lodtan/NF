 <form method="post" action="index.php">
		<fieldset>
	<legend><b><?php echo "Ajouter à l'annuaire des ingrédients" ?></b></legend>
        <p>
  		<label for="nom_id">Nom</label> :
  		<input type="text" name="nom" id="nom_id" required/>
	</p>

  <input type="hidden" name="controller" value="ingredient">
  <input type="hidden" name="action" value="<?php echo $action . 'd' ?>">
  <input type="hidden" name="id" value=0> 

  <p>
  		<input type="submit" value="Envoyer" />
	</p>
		</fieldset> 
</form>
