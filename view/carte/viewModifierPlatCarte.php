<form method="post" action="index.php">
		<fieldset>
	<legend><b><?php echo $pagetitle ?></b></legend>
	
    <label for="nom_id"> Nom du plat: </label>
   <input type="text" name="nom" required>
   <br>
    <label for="cate_id"> Catégorie: </label>
   <input type="text" name="cate" required>
   <br>
   <input type="checkbox" name="entree" value="true"  />Entrée<br>
   <input type="checkbox" name="plat" value="true"  />Plat<br>
   <input type="checkbox" name="dessert" value="true" />Déssert <br>
   
    <label for="prix_id"> Prix : </label>
   <input type="number" name="prix" step="any">
   

  <input type="hidden" name="controller" value="carte">
  <input type="hidden" name="action" value="updatePlat">
  <input type="hidden" name="id" value=<?php echo $id /*idplat */ ?>> 
   <input type="hidden" name="idcarte" value=<?php echo $idcarte /*idplat */ ?>> 

  <p>
  		<input type="submit" value="Envoyer" />
	</p>
		</fieldset> 
</form>
