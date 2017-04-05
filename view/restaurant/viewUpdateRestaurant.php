<form method="post" action="index.php">
		<fieldset>
	<legend><b><?php echo $pagetitle ?></b></legend>
		<p>
  		<label for="nom_id">Nom</label> :
  		<input type="text" value="<?php echo $n ?>" name="nom" id="nom_id" required/>
	</p>
	<p>
  		<label for="adresse_id">Adresse</label> :
  		<input type="text" value="<?php echo $a ?>" name="adresse" id="adresse_id"  required/>
	</p>
  <p>
      <label for="ville_id">Ville</label> :
      <select name="ville" id="ville_id">
            <?php 
            $i=0;
            foreach ($tab_ville as $v) { 
            ?>
            <?php if($v->getCodePostal()==$cp && $v->getPays()==$p) { ?>
              <option value="<?php echo $v->getCodePostal() . '&' . $v->getPays() ?>" selected><?php echo $v->getNom() ?></option>
            <?php } else { ?>
              <option value="<?php echo $v->getCodePostal() . '&' . $v->getPays() ?>"><?php echo $v->getNom() ?></option>
            <?php
              }
            }
            ?>
      </select>
  </p>
  <input type="hidden" name="controller" value="restaurant">
  <input type="hidden" name="action" value="<?php echo $action . 'd' ?>">
  <input type="hidden" name="id" value=<?php echo $idR ?>>

  <p>
  		<input type="submit" value="Envoyer" />
	</p>
		</fieldset> 
</form>

<p>
  <form method="post" action="index.php">
      <input type="hidden" name="controller" value="restaurant">
      <input type="hidden" name="action" value="createVille">
      <input type="hidden" name="idR" value=<?php if (isset($resto)) { echo $resto->getId(); } else { echo '-1'; } ?>>
    <input type="submit" value="Ajouter une ville" />
  </form>
</p>