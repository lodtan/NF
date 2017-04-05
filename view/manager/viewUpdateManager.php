<form method="post" action="index.php">
		<fieldset>
	<legend><b><?php echo $pagetitle ?></b></legend>
	<p>
  		<label for="nom_id">Nom</label> :
  		<input type="text" value="<?php echo $n ?>" name="nom" id="nom_id" required/>
	</p>
  <p>
      <label for="prenom_id">Prenom</label> :
      <input type="text" value="<?php echo $p ?>" name="prenom" id="prenom_id" required/>
  </p>
	<p>
  		<label for="datenaiss_id">Date de naissance</label> :
  		<input type="date" value="<?php echo $dn ?>" name="datenaiss" id="datenaiss_id"  required/>
	</p>
  <p>
      <label for="anciennete_id">Ancienneté</label> :
      <input type="date" value="<?php echo $a ?>" name="anciennete" id="anciennete_id"  required/>
  </p>

  <input type="hidden" name="controller" value="manager">
  <input type="hidden" name="action" value="<?php echo $action . 'd' ?>">
  <input type="hidden" name="idM" value=<?php echo $idM ?>>
  <input type="hidden" name="idR" value=<?php echo $idR ?>>

  <p>
  		<input type="submit" value="Envoyer" />
	</p>
		</fieldset> 
</form>