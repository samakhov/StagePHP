<?php 
	include_once("../fonctions/connexionDB.php");
	include_once("../fonctions/fonctionsInsert.php");
	include_once("../fonctions/fonctionsHelp.php");
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
			<?php 
				include_once("../includes/menu.php");
			?>
		<header>
		
		<section>
			<?php
				
				if (isset($_POST['nom']) AND isset($_POST['prenom'])){
					// vérification de l'unicité du nom du stage dans la base
					$sql = 'SELECT * FROM stagiaire WHERE NOM_STAGIAIRE = "'.$_POST['nom'].'" AND PRENOM_STAGIAIRE="'.$_POST['prenom'].'" ';
					$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
					$num_rows = mysql_num_rows($req);
					$indiceRedondance = 0;
					if ($num_rows>0){
						$indiceRedondance = 1;//Le stagiaire existe déjà dans la base
						
					}else{
						$indiceRedondance = 0;//Le stagiaire n'existe pas dans la base
						//mise de la date sous format de la base
						$dateNaiss = $_POST['annee'].'-'.$_POST['mois'].'-'.$_POST['jour'];
						
						$_POST['nom'] = htmlspecialchars($_POST['nom']);
						$_POST['prenom'] = htmlspecialchars($_POST['prenom']);
						$_POST['adresse'] = htmlspecialchars($_POST['adresse']);
						$_POST['codePoste'] = htmlspecialchars($_POST['codePoste']);
						$_POST['villeStagiaire'] = htmlspecialchars($_POST['villeStagiaire']);
						$_POST['TelephonePersonnel'] = htmlspecialchars($_POST['TelephonePersonnel']);
						$_POST['TelephoneService'] = htmlspecialchars($_POST['TelephoneService']);
						$_POST['TelephonePortable'] = htmlspecialchars($_POST['TelephonePortable']);
						$_POST['commentaire'] = htmlspecialchars($_POST['commentaire']);
						
						//Contrôle syntaxe des numéros de téléphone
						$indiceTelephone = VerificationTelephone($_POST['TelephonePersonnel']);
						$indiceTelephone += VerificationTelephone($_POST['TelephoneService']);
						$indiceTelephone += VerificationTelephone($_POST['TelephonePortable']);
						if ($indiceTelephone == 0){//Telephone syntaxe correcte
							InsertStagiaire($_POST['nom'], $_POST['prenom'], $dateNaiss, $_POST['sexe'], $_POST['adresse'], $_POST['codePoste'], $_POST['villeStagiaire'],
							$_POST['TelephonePersonnel'], $_POST['TelephoneService'], $_POST['TelephonePortable'], $_POST['stage'], $_POST['nationalite'], $_POST['commentaire']);
						}//if ($indiceTelephone == 0)
					}//if ($num_rows>0)
					
					//envoi des différents messages en fonction de $indiceRedondance et $indiceTelephone
					if ($indiceRedondance==0 AND $indiceTelephone==0){//Tout s'est bien passé
						echo '<h4 align="center"><font color="green"> Le stagiaire a été bien ajouté!<br/> Veuillez vous rendre sur la page des 
						<a href="stagiaire.php">Stagiaires</a> pour vérifier </font></h4>';
					}else if ($indiceRedondance == 1){//problème de redondance
						echo '<h4 align="center"><font color="red"> Le stagiaire existe déjà!<br/> Veuillez vous rendre sur la page des 
						<a href="stagiaire.php">Stagiaires</a> pour vérifier ou sur la page précédente pour changer de nom</font></h4>';
					}else if ($indiceTelephone !=0){//format numero de telephone incorrect
						echo '<h4 align="center"><font color="red"> numéros de téléphone saisis incorrect!<br/> Veuillez vous rendre sur la page précédente 
						pour modifier </font></h4>';
					}//else if ($indiceTelephone !=0)
				}else{
					echo '<h4 align="center"><font color="red"> URL incorrecte!<br/> Aucune donnée recue </font></h4>';
				}//if (isset($_POST['nom']) AND isset($_POST['prenom']))
			?>
		</section>
		<?php
			//fermeture de la connexion
			mysql_close ();
		?>
	</body>
</html>