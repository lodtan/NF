<h1>Ajout des ingrédient au plat</h1>


<form method="post" action="index.php">
		<fieldset>
<?php

for ($i= 0; $i < $nombre; $i++) {
//var_dump($r);
?>

                <select name="ingredient<?php echo $i ?>" size="1">
                <?php
                $sql = "SELECT nom FROM ingredient;";// SELECT idmenu, prix, nom
      
                $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
     
                $query_ingredient = pg_query($conn, $sql);
                
                
                 while($j = pg_fetch_row($query_ingredient)){
                ?>
                <option value="<?php echo $j[0] ?>" selected><?php echo $j[0] ?></option>
                <?php
                }
        
                ?>
                </select> 
                
                    <label for="quantite_id"> Quantité : </label>
                    <input type="number" name="quantite<?php echo $i ?>">
                    
                    <label for="mesure_id"> Mesure : </label>
                    <input type="text" name="mesure<?php echo $i ?>"> <br>
<?php 
}
?>

  <input type="hidden" name="controller" value="carte">
  <input type="hidden" name="action" value="addIngredientPlat">
  <input type="hidden" name="entree" value=<?php echo $entree ?>>
  <input type="hidden" name="plat" value=<?php echo $plat ?>>
  <input type="hidden" name="dessert" value=<?php echo $dessert ?>>
  <input type="hidden" name="categorie" value=<?php echo $categorie ?>>
  <input type="hidden" name="prix" value=<?php echo $prix ?>>
  <input type="hidden" name="nombre" value=<?php echo $nombre ?>>
  <input type="hidden" name="nom" value=<?php echo $nom ?>>
 
  
  <?php /* <input type="hidden" name="idplat" value=<?php echo $idplat ?>> */ ?>
  <input type="hidden" name="id" value=<?php echo $id  /* id carte */ ?>>
  
  <input type="submit" value="Envoyer" />
		</fieldset> 
</form>