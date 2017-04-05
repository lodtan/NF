<form method="post" action="index.php">
		<fieldset>
                <legend><b><?php echo "Supprimer une boisson de la carte" ?></b></legend>
                <select name="idboisson" size="1">
                <?php
                while ($row = pg_fetch_row($query_boissons)) {
                ?>
                <option value="<?php echo $row[0]?>" selected><?php echo $row[1] . " - " . $row[2] . " dl" ?></option>
                <?php
                }
                ?>
                </select>
                
                
                
                
                <input type="hidden" name="controller" value="boisson">
                <input type="hidden" name="action" value="deletedBoissonCarte">
                <input type="hidden" name="id" value=<?php echo $idcarte  /* id de la carte */ ?>> 
                
                <input type="submit" value="Supprimer" />
                </fieldset>
</form>