<form method="post" action="index.php">

		<fieldset>
	<legend><b><?php echo $pagetitle ?></b></legend>
	
            <label for="nom_id"> Nom du menu : </label>
            <input type="text" name="nom" required><br>
            
            <label for="nombre_id"> Nombre de plats dans le menu : </label>
            <input type="number" name="nombre" required>
	
	  <input type="hidden" name="controller" value="carte">
  <input type="hidden" name="action" value="choixPlats">
  <input type="hidden" name="id" value=<?php echo $id  /* id du resto */ ?>> 

  <p>
  		<input type="submit" value="Envoyer" />
		</fieldset> 
</form>