 <?php 
	include_once("../fonctions/connexionDB.php");
	include_once("../fonctions/fonctionsInsert.php");
	include_once("../fonctions/fonctionsHelp.php");
	ConnexionDB();
?>
<html>
	<head>
		<meta charset="utf-8" />
		<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="../CSS/IndexCSS.css" />
		<title>NOTE</title>
	</head>
	<body>
		<header>
			<?php include_once("../includes/menu.php"); ?>
		<header>

		<section>
			<?php
				$indice = 0;
				if (isset($_GET['reference'])){ 
					// vérification de l'authenticité de l'URL
					$_GET['reference'] = (int)$_GET['reference'];
					$sql = 'SELECT * FROM stagiaire WHERE REFERENCE_STAGIAIRE = "'.$_GET['reference'].'" ';
					$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
					$num_rows = mysql_num_rows($req);
					if ($num_rows>0){
						$indice = 1;//Alors l'URL est correct 
					}//if ($num_rows>0)
				}//if (isset($_GET['reference']))
				
				if ($indice==1){//Alors on peut afficher le relevé
					$sql="SELECT NOM_STAGIAIRE, PRENOM_STAGIAIRE, DATE_FORMAT(DATE_NAISS, '%d/%m/%Y') 
						AS DATE_NAISS, SEXE_STAGIAIRE FROM stagiaire WHERE REFERENCE_STAGIAIRE='".$_GET['reference']."'";
					$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
					$data= mysql_fetch_array($req);
					mysql_free_result($req);
			?>
			<table class="table table-condensed table-bordered">
					<caption>
						<h4>RELEVE DES NOTES</h4>
						<h4 align="left">NOM ET PRENOMS : <?php echo $data['NOM_STAGIAIRE'].'  '.$data['PRENOM_STAGIAIRE']; ?></h4>
						<h4 align="left">DATE DE NAISSANCE : <?php echo $data['DATE_NAISS']; ?></h4>
						<h4 align="left">SEXE : <?php echo $data['SEXE_STAGIAIRE']; ?></h4>
					</caption>
					<thead>
						<tr bgcolor="silver">
							<th>DISCIPLINES</th>
							<th>NOTE/20</th>
							<th>OBSERVATIONS</th>
						</tr>
					</thead>
					<tbody>
						
						<?php
							
							
							$sql = 'SELECT NOTE,CODE_DISCIPLINE FROM note WHERE REFERENCE_STAGIAIRE = "'.$_GET['reference'].'"';
							$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
							$notepratique=0;
							$notetheorie=0;
							$noteassiduite=0;
							$noteinsertion=0;
							$som = 0;
							$compteur=0;
							$rowlabel = "";
							$rowcolor = "";
							while($data = mysql_fetch_array($req)){
								if ($data['CODE_DISCIPLINE']==1){
									$rowlabel = "PRATIQUE";
									$som+=$data['NOTE'];
								}else if ($data['CODE_DISCIPLINE']==2){
									$rowlabel = "THEORIE";
									$som+=$data['NOTE'];
								}else if ($data['CODE_DISCIPLINE']==3){
									$rowlabel = "ASSIDUITE";
									$som+=$data['NOTE'];
								}else if ($data['CODE_DISCIPLINE']==4){
									$rowlabel = "INSERTION";
									$som+=$data['NOTE'];
								}//else if ($data['CODE_DISCIPLINE']==4)
								$compteur++;
								($compteur%2 == 1)?($rowcolor="white"):($rowcolor="silver");
								$observation = Observation($data['NOTE']);
						?>
							<tr bgcolor="<?php echo $rowcolor ;?>">
								<td><strong><?php echo $rowlabel ;?> </strong></td>
								<td><?php ControleNote($data['NOTE']); ?></td>
								<td><?php echo $observation ;?>  </td>
							</tr>
						
						<?php
							}//while($data = mysql_fetch_array($req))
							$moy = $som/4;
							$observation = Observation($moy);
						?>
							<tr>
								<td align="right"><h4>TOTAL</h4></td>
								<td><?php echo $som?></td>
								<td><?php echo '-' ;?>  </td>
							</tr>
							<tr bgcolor="silver">
								<td align="right"><h4>MOYENNE</h4></td>
								<td><?php echo $moy?></td>
								<td><?php echo $observation ;?>  </td>
							</tr>
									
				</tbody>
			</table>
			<?php
				}else{//Affichage d'un message d'erreur si l'URL est correct
					echo '<h4 align="center"><font color="red"> URL incorrecte!<br/> Aucune donnée recue </font></h4>';
				}//if ($indice==1)
			?>
		</section>
		<?php
			//fermeture de la connexion à la base
			mysql_close();
		?>

	</body>
</html>