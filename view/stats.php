

<?php  


	echo "<h1> Statistiques </h1>";


      $conn = pg_connect("host=tuxa.sme.utc port=5432 dbname=dbnf17p017 user=nf17p017 password=atEj2WfQ");
      
      $sql = "SELECT idplat, nom, sum(nb) as nb
				FROM
				(SELECT idplat, plat.nom, nb
				FROM plat
				INNER JOIN
					(SELECT idplat, sum(nb) as nb
					FROM
					 (SELECT idmenu, sum(quantite) as nb
					 FROM commandemenu
					 GROUP BY idmenu
					 ORDER BY sum(quantite) DESC) R1
					
					INNER JOIN platmenu
					ON R1.idmenu = platmenu.idmenu
					GROUP BY idplat) R2
				ON R2.idplat = plat.id

				UNION

				SELECT idplat, plat.nom, nb
				FROM
					(SELECT idplat, sum(quantite) as nb
					FROM commandeplat
					GROUP BY idplat
					ORDER BY sum(quantite) DESC) R1
				INNER JOIN plat
				ON R1.idplat = plat.id)R4

				GROUP BY idplat, nom
				ORDER BY sum(nb) DESC
				;"
		;
		
		$sql2 = "SELECT categorie, sum(nb)
				FROM
				(SELECT categorie, sum(quantite) as nb
				FROM commandeMenu, platMenu, Plat
				WHERE commandemenu.idmenu=platMenu.idmenu AND platMenu.idplat=Plat.id AND (categorie='viande' OR categorie='poisson')
				GROUP BY categorie

				UNION

				SELECT categorie, sum(quantite) as nb
				FROM commandePlat, Plat
				WHERE commandePlat.idplat=Plat.id AND (categorie='viande' OR categorie='poisson')
				GROUP BY categorie
				ORDER BY nb) R1
				GROUP BY categorie;";
				
		$sql3 = "SELECT idcommande, sum(prix) as prix
				FROM	
					(SELECT idcommande,  sum(quantite*prix) as prix
					FROM commandeboisson
					INNER JOIN carteboisson
					ON carteboisson.idboisson = commandeboisson.idboissonvendue
					GROUP BY idcommande

					UNION

					SELECT idcommande, sum(quantite*prix) as prix
					FROM commandeplat
					INNER JOIN carteplat
					ON carteplat.idplat= commandeplat.idplat
					GROUP BY idcommande

					UNION

					SELECT idcommande, sum(quantite*prix) as prix
					FROM commandemenu
					INNER JOIN cartemenu
					ON cartemenu.idmenu= commandemenu.idmenu
					GROUP BY idcommande) R1
				GROUP BY idcommande
				";
		$sql4 = "SELECT  sum(totaldessertcom)/(SELECT count (*) FROM commande) as prixmoyendessert
				FROM
				(SELECT R2.idcommande, sum(quantite*prix) as totaldessertcom
					FROM
						(SELECT idcommande, idplat, R1.nom, commandeplat.quantite --sel 1
						FROM
							(SELECT id, nom
							FROM plat
							WHERE dessert = TRUE) R1

						INNER JOIN commandeplat
						ON commandeplat.idplat = R1.id) R2 -- sel 1 (prend les desserts des commandes plats)
					INNER JOIN carteplat
					ON R2.idplat = carteplat.idplat
					GROUP BY idcommande) R3;
				";
				
		$sql5 = "SELECT nom, nbemploye
				FROM
					(SELECT idresto, count(id) as nbemploye
					FROM serveur
					GROUP BY idresto

					UNION 

						(SELECT idresto, count(id) as nbemploye
						FROM cuisinier
						GROUP BY idresto

						UNION

						SELECT idresto, count(id) as nbemploye
						FROM manager
						GROUP BY idresto
						) 
					)R1
				INNER JOIN restaurant
				ON R1.idresto = restaurant.id
				";
		$sql6 = "SELECT id, nom, anciennete
				FROM manager

				UNION

					(SELECT  id, nom, anciennete
					FROM serveur

					UNION 

					SELECT id, nom, anciennete
					FROM cuisinier)

				ORDER BY anciennete
				";

		$sql7 = "SELECT volume, nom, annee, quantite 
				FROM commandeboisson
				INNER JOIN boissonvendue
				ON boissonvendue.id = commandeboisson.idboissonvendue
				ORDER BY quantite;";
	
	
      $result = pg_query($conn, $sql);
	  $result2 = pg_query($conn, $sql2);
	  $result3 = pg_query($conn, $sql3);
	  $result4 = pg_query($conn, $sql4);
	  $result5 = pg_query($conn, $sql5);
	  $result6 = pg_query($conn, $sql6);
	  $result7 = pg_query($conn, $sql7);
	  
	  echo "<h2>Plats les plus commandés (en menu ou pas) </h2>";
	  echo "<table>
				<tr>
					<th>  Nom du plat </th>
					<th> Nombre de plats commandes <th>
				</tr>" ;
      
      while($id = pg_fetch_row($result)) // utiliser $annee[0]
		{   
		
					
			echo "<tr>
					<td> $id[1] </td>
					<td> $id[2] </td>
				</tr>";
        
		}

	
		echo "</table> </br>";
		
		
	echo "<h2> Nombre de plats de viande/poisson commandés </h2>";
	echo "<table>
				<tr>
					<th>  Catégorie </th>
					<th> Nombre de plats commandes <th>
				</tr>" ;
      
      while($id = pg_fetch_row($result2)) // utiliser $annee[0]
		{   
		
					
			echo "<tr>
					<td> $id[0] </td>
					<td> $id[1] </td>
				</tr>";
        
		};

	
		echo "</table> </br>";
		
	echo "<h2> Prix des commandes </h2>";
	echo "<table>
				<tr>
					<th>  Numéro de la commande </th>
					<th> Prix <th>
				</tr>" ;
      
      while($id = pg_fetch_row($result3)) // utiliser $annee[0]
		{   
		
					
			echo "<tr>
					<td> $id[0] </td>
					<td> $id[1] </td>
				</tr>";
        
		};

	
		echo "</table> </br>";	
		
	echo "<h2> Somme en moyenne dépensée sur les desserts pour chaque commande </h2>";
	
    $id = pg_fetch_row($result4);// utiliser $annee[0]
	
	$moy = round($id[0], 2);
	echo "La moyenne de la somme dépensée sur les desserts est de : $moy € ";
	
	echo "<h2> Nombre d'employés en fonction du restaurant </h2>";
	echo "<table>
				<tr>
					<th>  Nom du restaurant </th>
					<th> Nombre d'employés <th>
				</tr>" ;
      
      while($id = pg_fetch_row($result5)) // utiliser $annee[0]
		{   
		
					
			echo "<tr>
					<td> $id[0] </td>
					<td> $id[1] </td>
				</tr>";
        
		};

	
		echo "</table> </br>";	
		
	echo "<h2> Ancienneté des employés </h2>";
	echo "<table>
				<tr>
					<th> ID </th>
					<th>  Nom de l'employé </th>
					<th> Ancienneté <th>
				</tr>" ;
      
      while($id = pg_fetch_row($result6)) // utiliser $annee[0]
		{   
		
					
			echo "<tr>
					<td> $id[0] </td>
					<td> $id[1] </td>
					<td> $id[2] </td>
				</tr>";
        
		};

	
		echo "</table> </br>";	


	echo "<h2>Boissons les plus commandées </h2>";
	  echo "<table>
				<tr>
					<th> Boisson </th>
					<th> Volume <th>
					<th> Année </th>
					<th> Quantité </th>
				</tr>" ;
      
      while($id = pg_fetch_row($result7)) // utiliser $annee[0]
		{   
		
					
			echo "<tr>
					<td> $id[1] </td>
					<td> $id[0] </td>
					<td> $id[2] </td>
					<td> $id[3] </td>
				</tr>";
        
		};

	
		echo "</table> </br>";
		


	
	echo "<form>";
	echo "<input type = 'button' value='Retour' onClick='history.go(-1)'>";
	echo "</form> ";



/**$sql2 = "SELECT * FROM boisson ";

$result2 = pg_query($conn, $sql2);
while($id = pg_fetch_row($result2)) // utiliser $annee[0]
    {   
		
					
        echo "<table><tr>
				<td> $id[0] </td>
				<td> $id[1] </td>
			</tr></table>";
        
    };**/

?>  

