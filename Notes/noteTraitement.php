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
		<title>NOTE</title>
	</head>
	<body>
		<header>
			<?php 
				include_once("../includes/menu.php");
			?>
		<header>
		
		<section>
			<?php
				
				foreach ($_POST as $cle => $element){
					$ind = "";
					$value = 0;
					switch ($cle) 
					{//Pour trouver les disciplines et leur Note
						case "pratique":
							$ind = "pratique";
							$value = $_POST['pratique'];
							break;
						case "theorie":
							$ind = "theorie";
							$value = $_POST['theorie'];
							break;
						case "assiduite":
							$ind = "assiduite";
							$value = $_POST['assiduite'];
							break;
						case "insertion":
							$ind = "insertion";
							$value = $_POST['insertion'];
							break;
						default:
							break;
						
					}//switch ($cle)
					if ($ind != ""){//Si le nom de la matière a été renseigné
						$ind = strtoupper($ind);
						$sql = 'SELECT CODE_DISCIPLINE FROM discipline WHERE DISCIPLINE="'.$ind.'"';
						$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						$data = mysql_fetch_array($req);
						
						InsertNote($_POST['referenceStagiaire'], $value, $data['CODE_DISCIPLINE']);
						$indiceEffectue=1;
						mysql_free_result($req);
					}//if ($ind != "")
					echo '<h4 align="center"><font color="green">Les Notes ont été bien ajoutées!<br />Pour vérifier rendez vous sur 
							la page des <a href="note.php">Notes</a></font></h4>';
				}//foreach ($_POST as $cle => $element)
				
				if ($indiceEffectue==1){//C'est que l'insert s'est fait
					echo '<h4 align="center"><font color="green">Les Notes ont été bien ajoutées!<br />Pour vérifier rendez vous sur 
						la page des <a href="note.php">Notes</a></font></h4>';
				}//if ($indiceEffectue==1): pour afficher un mesage
				
				//header('Location:note.php');
			?>
		</section>
		<?php 
			//fermeture de la connexion à la base
			mysql_close();
		?>
	</body>
</html>