<?php include_once("../fonctions/connexionDB.php");
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
			<form method="post" action="noteTraitement.php">
				<fieldset>
					<legend>Fiche de remplissage des notes</legend>
						<label for="stagiaire">Stagiaire : </label>
						<select name="referenceStagiaire">
						<?php
						$sql = 'SELECT REFERENCE_STAGIAIRE, NOM_STAGIAIRE, PRENOM_STAGIAIRE FROM stagiaire';//Tous les stagiaires enregistrés
						$reqStagiaire = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						
						$sql = 'SELECT DISTINCT REFERENCE_STAGIAIRE FROM note';//Seuls les stagiaires qui ont des notes
						$reqNote = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						
						while($data=mysql_fetch_array($reqStagiaire)){
							$dataN=mysql_fetch_array($reqNote);
							if (!in_array($data['REFERENCE_STAGIAIRE'],$dataN)){//la référence n'existe donc pas la table des notes
						?>	
								<option value="<?php echo $data['REFERENCE_STAGIAIRE']; ?>"><?php echo $data['NOM_STAGIAIRE'].' '.$data['PRENOM_STAGIAIRE']; ?></option>
						
						<?php
							}//if (!in_array($data['REFERENCE_STAGIAIRE'],$dataN)): pour selectionner les stagiaires qui n'ont pas de notes
						}//while($data=mysql_fetch_array($req)):afficher les stagiaires
						mysql_free_result ($reqStagiaire);
						mysql_free_result ($reqNote);
						?>
						</select><br/><br/>
						
						<label for="prat">Pratique : </label>
						<input type="number" step=0.25 min=0 max=20 name="pratique" id="prat" required /><br/><br/>
						
						<label for="theo">Théorie : </label>
						<input type="number" step=0.25 min=0 max=20 name="theorie" id="theo" required /><br/><br/>
						
						<label for="ass">Assiduité : </label>
						<input type="number" step=0.25 min=0 max=20 name="assiduite" id="ass" required /><br/><br/>
						
						<label for="insert">Insertion : </label>
						<input type="number" step=0.25 min=0 max=20 name="insertion" id="insert" required /><br/><br/>
						
						<button type="submit" class="btn span1 offset3">Envoyer</button>
				</fieldset>
			</form>
		</section>
		<?php
			//fermeture de la connexion
			mysql_close ();
		?>
	</body>
</html>