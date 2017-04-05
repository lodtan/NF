<form method="post" action="index.php">
		<fieldset>
	<legend><b><?php echo $pagetitle ?></b></legend>
		<p>
  		<label for="deb_id">Date de début(AAAA-MM-JJ) </label> :
  		<input type="text" name="datedeb" id="deb_id" required/>
	</p>
	<p>
  		<label for="fin_id">Date de fin(AAAA-MM-JJ) </label> :
  		<input type="text" name="datefin" id="fin_id" required/>
	</p>

  <input type="hidden" name="controller" value="carte">
  <input type="hidden" name="action" value="<?php echo $action . 'd' ?>">
  <input type="hidden" name="id" value=<?php echo $id  /* id du resto */ ?>> 

  <p>
  		<input type="submit" value="Envoyer" />
	</p>
		</fieldset> 
</form>