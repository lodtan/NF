<form method="post" action="index.php">
		<fieldset>
                <legend><b><?php echo $pagetitle ?></b></legend>
                <select name="idplat" size="1">
                <?php
                while ($row = pg_fetch_row($query_plats)) {
                ?>
                <option value="<?php echo $row[1]?>" selected><?php echo $row[4] ?></option>
                <?php
                }
                ?>
                </select>
                
                
                
                
                <input type="hidden" name="controller" value="carte">
                <input type="hidden" name="action" value="deletedPlat">
                <input type="hidden" name="id" value=<?php echo $id  /* id de la carte */ ?>> 
                
                <input type="submit" value="Supprimer" />
                </fieldset>
</form>