<?php 
	include_once("../fonctions/connexionDB.php");
	include_once("../fonctions/fonctionsDelete.php");
	ConnexionDB();
?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="robot" content="index">
		<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="../CSS/IndexCSS.css" />
		<title>STAGIAIRE</title>
	</head>
	<body>
		<header>
			<?php 
				include_once("../includes/menu.php");
			?>
		<header>
		
		<section>
			<?php
			
				
				$indice = 0;
				if (isset($_GET['referenceStagiaire'])){ 
					// vérification de l'authenticité de l'URL
					$sql = 'SELECT * FROM stagiaire WHERE REFERENCE_STAGIAIRE = "'.$_GET['referenceStagiaire'].'" ';
					$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
					$num_rows = mysql_num_rows($req);
					if ($num_rows>0){
						$indice = 1;//Alors c'est bon, ce stagiaire existe effectivement dans la base
					}//if ($num_rows>0)
				}//if (isset($_GET['referenceStagiaire']))
						
				if ($indice==1){
					if(DeleteStagiaire($_GET['referenceStagiaire'])){
						echo '<h4 align="center"><font color="green"> Le stagiaire a été bien supprimé!<br/> Veuillez vous rendre sur la page des 
						<a href="stagiaire.php">Stagiaires</a> pour vérifier </font></h4>';
					}
				}else{
					echo '<h4 align="center"><font color="red"> URL incorrecte! <br/> Le stagiaire n\'existe pas!</font></h4>';
				}//if ($indice)
							
				//header('Location:stagiaire.php');
			?>
		</section>
	</body>
</html>