<form method="post" action="index.php">
		<fieldset>
	<legend><b><?php echo $pagetitle ?></b></legend>
	
    <label for="nom_id"> Nom du plat: </label>
   <input type="text" name="nom" required>
   <br>
    <label for="cate_id"> Catégorie: </label>
   <input type="text" name="cate" required>
   <br>
   <input type="checkbox" name="entree" value="true" />Entrée<br>
   <input type="checkbox" name="plat" value="true"  />Plat<br>
   <input type="checkbox" name="dessert" value="true"/>Déssert <br>
   
    <label for="nombre_id"> Nombre d'ingrédient dans le plat : </label>
   <input type="number" name="nombre" required>
   
    <label for="prix_id"> Prix : </label>
   <input type="number" name="prix" step="any" required>
   

  <input type="hidden" name="controller" value="carte">
  <input type="hidden" name="action" value="selectionPlat">
  <input type="hidden" name="id" value=<?php echo $id  /* id de la carte */ ?>> 

  <p>
  		<input type="submit" value="Envoyer" />
	</p>
		</fieldset> 
</form>

<!-- Autre formulaire -->

<form method="post" action="index.php">
		<fieldset>
                <legend><b><?php echo "Ajouter un plat existant" ?></b></legend>
                <select name="idplat" size="1">
                <?php
                while ($row = pg_fetch_row($query_plats)) {
                ?>
                <option value="<?php echo $row[0]?>" selected><?php echo $row[1] ?></option>
                <?php
                }
                ?>
                </select>
                
                
                <label for="prix_id"> Prix : </label>
                <input type="number" name="prix" step="any">
                
                <input type="hidden" name="controller" value="carte">
                <input type="hidden" name="action" value="ajoutPlatExistant">
                <input type="hidden" name="id" value=<?php echo $id  /* id de la carte */ ?>> 
                
                <input type="submit" value="Envoyer" />
                </fieldset>
</form>