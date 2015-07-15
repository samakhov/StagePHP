<?php 
	include_once("../fonctions/connexionDB.php");
	include_once("../fonctions/fonctionsUpdate.php");
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
		<header>
			<?php 
				//include_once("../includes/menu.php");
			?>
		<header>
		
		<section>
			<?php
				
				if (isset($_GET['referenceStage'])){
					if (isset($_POST['nom'])){
					
						$_POST['nom'] = htmlspecialchars($_POST['nom']);
						$_POST['commentaire'] = htmlspecialchars($_POST['commentaire']);
						//mise des dates au format normal de la base
						$dateDebut =  $_POST['anneeDebut'].'-'.$_POST['moisDebut'].'-'.$_POST['jourDebut'];
						$dateFin =  $_POST['anneeFin'].'-'.$_POST['moisFin'].'-'.$_POST['jourFin'];
						
						
						UpdateStage($_POST['nom'], $dateDebut, $dateFin, $_POST['commentaire'], $_GET['referenceStage']);
					}
				}else{
					echo '<h4 align="center"><font color="red"> URL incorrecte!<br/> Veuillez vous rendre sur la page précédente 
						pour reprendre </font></h4>';
				}
				//header('Location:../index.php');
			?>
		</section>
		<?php
			//fermeture de la connexion
			mysql_close ();
		?>
	</body>
</html>