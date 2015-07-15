 <?php 
	include_once("../fonctions/connexionDB.php");
	include_once("../fonctions/fonctionsInsert.php");
	ConnexionDB();
?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="robot" content="index">
		<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="../CSS/IndexCSS.css" />
		<title>ACCUEIL</title>
	</head>
	<body>
		<header>
			<?php include_once("../includes/menu.php"); ?>
		<header>

		<section>
			<table class="table table-bordered table-condensed">
					<caption>
						<h4>LISTE DES ETUDIANTS ET LEURS NOTES</h4>
					</caption>
					<thead>
						<tr>
							<th></th>
							<th>N°</th>
							<th>NOM ET PRENOMS</th>
							<th>PRATIQUE</th>
							<th>THEORIE</th>
							<th>ASSIDUITE</th>
							<th>INSERTION</th>
							<th>TOTAL</th>
							<th>MOYENNE</th>
						</tr>
					</thead>
					<tbody>
						
						<?php

							$sql = 'SELECT DISTINCT stagiaire.NOM_STAGIAIRE, stagiaire.PRENOM_STAGIAIRE, stagiaire.REFERENCE_STAGIAIRE FROM note,stagiaire
								WHERE note.REFERENCE_STAGIAIRE = stagiaire.REFERENCE_STAGIAIRE ORDER BY stagiaire.NOM_STAGIAIRE, stagiaire.PRENOM_STAGIAIRE';
							$req = mysql_query($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
								
							$i=1;
							while($data = mysql_fetch_array($req)){
								$somme = 0;
								$moyenne = 0;
								
								$sql = 'SELECT NOTE, CODE_DISCIPLINE FROM note WHERE
									note.REFERENCE_STAGIAIRE="'.$data['REFERENCE_STAGIAIRE'].'" ORDER BY CODE_DISCIPLINE ASC';
								$req2 = mysql_query($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
								//en ordonnant suivant les disciplines, on a l'ordre d'affichage des notes de notre tableau
						?>
								<tr>
									<td>
										<a class="btn btn-link" href="noteUpdate.php?reference=<?php echo $data['REFERENCE_STAGIAIRE'] ;?>"><i class="icon-pencil"></i>Modifier</a>
										<a class="btn btn-link" href="noteReleve.php?reference=<?php echo $data['REFERENCE_STAGIAIRE'] ;?>"><i class="icon-list-alt"></i>Relevé de Notes</a>
									</td>
									<td><?php echo $i ;?></td>
									<td><?php echo $data['NOM_STAGIAIRE'].' '.$data['PRENOM_STAGIAIRE'] ;?></td>
									<?php
										while ($data2 = mysql_fetch_array($req2)){
											echo '<td>'. $data2['NOTE'].'</td>';//affichage des notes                           
											$somme += $data2['NOTE'];
										}//while ($data2 = mysql_fetch_array($req2)):pour avoir les notes suivant les disciplines pour chaque stagiaire
										$moyenne = $somme/4;
									?>
									<td><?php echo $somme ;?></td>
									<td><?php echo $moyenne ;?></td>
								</tr>
						<?php	
								mysql_free_result($req2);
								$i++;
							}//while($data = mysql_fetch_array($req)): pour parcourir tous les stagiaires ayant des notes
							mysql_free_result($req);
						?>
				</tbody>
			</table>
					
			<div class="span1 offset7">
				<a class="btn" href="noteSaisie.php">Saisir</a>
			</div><br /><br />
			<p><h4>Consulter la liste des <a href="../Stagiaires/stagiaireAdmis.php">Stagiaires Admis</a></h4></p>
			<?php
				mysql_close();
			?>
		</section>
	</body>
</html>