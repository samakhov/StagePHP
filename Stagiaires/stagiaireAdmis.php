<?php 
	include_once("../fonctions/connexionDB.php");
	ConnexionDB();
?>
<html>
	<head>
		<meta charset="utf-8" />
		<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="../CSS/IndexCSS.css" />
		<title>STAGIAIRES</title>
	</head>
	<body>
		<header>
			<?php include_once("../includes/menu.php"); ?>	
		</header>
			
		<section>
			<table class="table table-bordered table-condensed">
				<caption>
					<h4>LISTE ALPHABETIQUE DES STAGIAIRES ADMIS</h4>
				</caption>
				<thead>
					<tr>
						<th>N°</th>
						<th>NOM ET PRENOMS</th>
						<th>TOTAL</th>
						<th>MOYENNE</th>
					</tr>
				</thead>
				<tbody>
				<?php
				
					$sql = 'SELECT * FROM stagiaire ORDER BY NOM_STAGIAIRE, PRENOM_STAGIAIRE';
					$reqS = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
					
					$i=1;
					while($dataS = mysql_fetch_array($reqS)){
						//Opération de récupération du total de ses notes et calcul de la moyenne
						$sql = 'SELECT SUM(NOTE) AS somme FROM note WHERE REFERENCE_STAGIAIRE = "'.$dataS['REFERENCE_STAGIAIRE'].'"';
						$reqN = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						$dataN = mysql_fetch_array($reqN);
						$moyenne = $dataN['somme']/4;
						
						echo '<tr>
								<td>'.$i.'</td>
								<td>'.$dataS['NOM_STAGIAIRE'].'  '. $dataS['PRENOM_STAGIAIRE'].'</td>
								<td>'.$dataN['somme'].'</td>
								<td>'.$moyenne.'</td>
							</tr>';
						$i+=1;
						mysql_free_result($reqN);
					}//while($dataS = mysql_fetch_array($reqS)):parcourir la liste des stagiaires
					mysql_free_result($reqS);
					
				?>
				</tbody>
			</table>
		</section>
		<?php
			//fermeture de la connexion
			mysql_close ();
		?>	
	</body>
</html>