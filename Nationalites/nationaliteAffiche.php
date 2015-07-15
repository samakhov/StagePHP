<?php 
	include_once("../fonctions/connexionDB.php");
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
					<?php
						/*$ind = true;
						$sql = 'SELECT MAX(CODE_NATIONALITE) AS code_max, MIN(CODE_NATIONALITE) AS code_min FROM nationalite';
						$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						while ($data = mysql_fetch_array($req)){
							$code_max = $data['code_max'];
							$code_min = $data['code_min'];
						}
						mysql_free_result($req);*/
								$code = $_POST['nationalite'];
								$sql = 'SELECT NATIONALITE FROM nationalite WHERE CODE_NATIONALITE = "'.$code.'"';
								$reqn = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
								$data = mysql_fetch_array($reqn);
								mysql_free_result($reqn);
								$ind = true;
						//}//if (isset($_GET['nationalite']))
						
						if ($ind){
					?>	
							<h4>NATIONALITE : <?php echo $data['NATIONALITE']; ?></h4>
							</caption>
							<thead>
								<tr>
									<th>N°</th>
									<th>NOM ET PRENOMS</th>
									<th>DATE DE NAISSANCE</th>
									<th>SEXE</th>
									<th>TELEPHONE PORTABLE</th>
								</tr>
							</thead>
							<tbody>
								<?php
									
								$sql = "SELECT NOM_STAGIAIRE, PRENOM_STAGIAIRE, SEXE_STAGIAIRE, TELEPHONE_PORTABLE, DATE_FORMAT(DATE_NAISS, '%d/%m/%Y') 
									AS DATE_NAISS FROM stagiaire WHERE CODE_NATIONALITE ='".$code."' ORDER BY NOM_STAGIAIRE, PRENOM_STAGIAIRE ";
								$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
								$i=1;
								while($data = mysql_fetch_array($req)){
									if ($data['NOM_STAGIAIRE']==''){
										echo '<p>Pas de Stagiaire de cette nationalite</p>';
									}else {
										echo '<tr>
											<td>'.$i.'</td>
											<td>'.$data['NOM_STAGIAIRE'].'  '.$data['PRENOM_STAGIAIRE'].'</td>
											<td>'.$data['DATE_NAISS'].'</td>
											<td>'.$data['SEXE_STAGIAIRE'].'</td>
											<td>'.$data['TELEPHONE_PORTABLE'].'</td>
										</tr>';
									}//if ($data['NOM_STAGIAIRE']=='')
									$i+=1;
								}//while($data = mysql_fetch_array($req))
								mysql_free_result($req);
								?>
							</tbody>
					
					<?php
						}else {
							echo 'Pas de stagiaire de cette nationalité';
						}//if ($ind)
					?>
				</table>
		</section>
	</body>
</html>