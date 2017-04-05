<form method="post" action="index.php">
		<fieldset>
	<legend><b><?php echo $pagetitle ?></b></legend>
	<p>
  		<label for="codepostal">Code postal</label> :
  		<input type="text" value="<?php echo $cp ?>" name="codepostal" id="codepostal_id"  required/>
	</p>
    <p>
      <label for="pays">Pays</label> :
      <input type="text" value="<?php echo $p ?>" name="pays" id="pays_id"  required/>
  </p>
  <p>
      <label for="nom_id">Nom</label> :
      <input type="text" value="<?php echo $n ?>" name="nom" id="nom_id" required/>
  </p>
  <input type="hidden" name="controller" value="restaurant">
  <input type="hidden" name="action" value="createdVille">
  <input type="hidden" name="id" value=<?php echo $_POST['idR'] ?>>

  <p>
  		<input type="submit" value="Envoyer" />
	</p>
		</fieldset> 
</form>