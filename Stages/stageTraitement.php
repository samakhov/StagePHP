<?php 
	include_once("../fonctions/connexionDB.php");
	include_once("../fonctions/fonctionsInsert.php");
	ConnexionDB();
?>
<html>
	<head>
		<meta charset="utf-8" />
		<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="../CSS/IndexCSS.css" />
		<title>ACCUEIL</title>
	</head>
	<body>
		<section>
			<?php
				if (isset($_POST['nom'] AND isset($_POST['commentaire'])){
					$_POST['nom'] = htmlspecialchars($_POST['nom']);
					//mise des dates au format de la base
					$dateDebut =  $_POST['anneeDebut'].'-'.$_POST['moisDebut'].'-'.$_POST['jourDebut'];
					$dateFin =  $_POST['anneeFin'].'-'.$_POST['moisFin'].'-'.$_POST['jourFin'];
						
					$_POST['commentaire'] = htmlspecialchars($_POST['commentaire']);
						
					// vérification de l'unicité du nom du stage dans la base
					$sql = 'SELECT * FROM stage WHERE NOM_STAGE = "'.$_POST['nom'].'" ';
					$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
					$num_rows = mysql_num_rows($req);
					if ($num_rows>0){
			?>
						<script> alert('Le stage saisi existe déjà'); </script>
			<?php
						//$messageErreur .= "Le stage saisi existe déjà<br/>";
						header('Location:stageSaisie.php');
					}
					
					InsertStage($_POST['nom'], $dateDebut, $dateFin, $_POST['commentaire']);
				}//if (isset($_POST['nom']))

				header('Location:../index.php');
			?>
		</section>
	</body>
</html>