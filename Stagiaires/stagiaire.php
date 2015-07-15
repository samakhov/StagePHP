<?php 
	include_once("../fonctions/connexionDB.php");
	//include_once("../fonctions/fonctionsInsert.php");
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
					<h4>LISTE DES STAGIAIRES</h4>
				</caption>
				<thead>
					<tr>
						<th></th>
						<th>N°</th>
						<th>NOM ET PRENOMS</th>
						<th>DATE DE NAISSANCE</th>
						<th>SEXE</th>
						<th>TELEPHONE PORTABLE</th>
					</tr>
				</thead>
				<tbody>
				<?php
				
					$sql = "SELECT REFERENCE_STAGIAIRE, NOM_STAGIAIRE, PRENOM_STAGIAIRE, SEXE_STAGIAIRE, TELEPHONE_PORTABLE, DATE_FORMAT(DATE_NAISS, '%d/%m/%Y') 
						AS DATE_NAISS FROM stagiaire ORDER BY NOM_STAGIAIRE, PRENOM_STAGIAIRE";
					$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
					$i=1;
					while($data = mysql_fetch_array($req)){
						echo '<tr>
								<td>
									<a class="btn btn-link" href="stagiaireUpdate.php?referenceStagiaire='.$data['REFERENCE_STAGIAIRE'].'"><i class="icon-pencil"></i>Modifier</a>
									<a class="btn btn-link" href="stagiaireDelete.php?referenceStagiaire='.$data['REFERENCE_STAGIAIRE'].'"><i class="icon-remove-sign"></i>Supprimer</a>
								</td>
								<td>'.$i.'</td>
								<td>'.$data['NOM_STAGIAIRE'].'  '. $data['PRENOM_STAGIAIRE'].'</td>
								<td>'.$data['DATE_NAISS'].'</td>
								<td>'.$data['SEXE_STAGIAIRE'].'</td>
								<td>'.$data['TELEPHONE_PORTABLE'].'</td>
							</tr>';
						$i+=1;
					}//while($data = mysql_fetch_array($req)): parcourir la liste des stagiaires
					mysql_free_result($req);
					
				?>
				</tbody>
			</table>
			
			<div class="span1 offset7">
				<a class="btn" href="stagiaireSaisie.php">Saisir</a>
			</div>
		</section>
		<?php
			//fermeture de la connexion
			mysql_close ();
		?>	
	</body>
</html>