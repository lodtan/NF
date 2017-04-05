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
  <p>
      <label for="accueil_id">Accès accueil</label> :
      <?php if($acc=="true") { ?>
      <input type="radio" name="accueil" value="true" checked> Oui
      <input type="radio" name="accueil" value="false"> Non<br>
      <?php } else if ($acc=="false") { ?>
      <input type="radio" name="accueil" value="true"> Oui
      <input type="radio" name="accueil" value="false" checked> Non<br>
      <?php } else { ?>
      <input type="radio" name="accueil" value="true"> Oui
      <input type="radio" name="accueil" value="false"> Non<br>
      <?php } ?>
  </p>

  <input type="hidden" name="controller" value="serveur">
  <input type="hidden" name="action" value="<?php echo $action . 'd' ?>">
  <input type="hidden" name="idS" value=<?php echo $idS ?>>
  <input type="hidden" name="idR" value=<?php echo $idR ?>>

  <p>
  		<input type="submit" value="Envoyer" />
	</p>
		</fieldset> 
</form>