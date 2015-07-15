<?php include_once("/fonctions/connexionDB.php");
	ConnexionDB();
?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="robot" content="index">
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="CSS/IndexCSS.css" />
		<title>ACCUEIL</title>
	</head>
	<body>
			<header>
				<?php include_once("includes/menuIndex.php"); ?>
			</header>
			
			<section class="d2">
				<?php
					$sql = 'SELECT COUNT(*) AS nbreStages FROM stage';
					$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
					$data = mysql_fetch_array($req);
					if ($data['nbreStages'] > 0){
				?>
				<table class="table table-bordered table-condensed">
					<caption>
						<h4>LISTE DES STAGES DISPONIBLES</h4>
					</caption>
					<thead>
						<tr>
							<th></th>
							<th>N°</th>
							<th>NOM</th>
							<th>DEBUT DU STAGE</th>
							<th>FIN DU STAGE</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$sql = "SELECT REFERENCE_STAGE, NOM_STAGE, DATE_FORMAT(DATE_DEBUT_STAGE, '%d/%m/%Y') AS DATE_DEBUT_STAGE, 
							DATE_FORMAT(DATE_FIN_STAGE, '%d/%m/%Y') AS DATE_FIN_STAGE FROM stage";
						$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						$i = 1;
						while ($data = mysql_fetch_array($req)){
							echo '<tr>
									<td>
										<a class="btn btn-link" href="Stages/stageUpdate.php?referenceStage='.$data['REFERENCE_STAGE'].'"><i class="icon-pencil"></i>Modifier</a>
									</td>
									<td>'.$i.'</td>
									<td>'.$data['NOM_STAGE'].'</td>
									<td>'.$data['DATE_DEBUT_STAGE'].'</td>
									<td>'.$data['DATE_FIN_STAGE'].'</td>
								</tr>';
							$i+=1;
						}
						mysql_free_result($req);
					
					?>
					</tbody>
				</table>	
					
					<?php
						} else {
							echo '<h2><strong>Bienvenue sur cette application de getion des stagiaires<br /> Pour le moment aucun stage n\'est en cours, Vous devrez 
								en créer avant d\'ajouter des stagiaires</strong></h2><br /><br />';
						}//if ($data['nbreStages'] > 0)
					
					?>
				<div class="span1 offset7">
					<a class="btn" href="Stages/stageSaisie.php">Saisir</a>
				</div>
			</section>
	</body>
</html>