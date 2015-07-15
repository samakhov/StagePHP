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
			<?php
				$sql = 'SELECT NOM_STAGIAIRE, PRENOM_STAGIAIRE FROM stagiaire WHERE REFERENCE_STAGIAIRE="'.$_GET['reference'].'"';
				$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
				$data = mysql_fetch_array($req);
				$ref_stagiaire = $_GET['reference'];
				$nom = $data['NOM_STAGIAIRE'];
				$prenom = $data['PRENOM_STAGIAIRE'];
				mysql_free_result($req);
				
				$sql = 'SELECT NOTE, CODE_DISCIPLINE FROM note WHERE REFERENCE_STAGIAIRE = "'.$ref_stagiaire.'"';
				$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
				
				$notepratique2=0;
				$notetheorie2=0;
				$noteassiduite2=0;
				$noteinsertion2=0;
								
				while($data = mysql_fetch_array($req)){
					if ($data['CODE_DISCIPLINE']==1){
						$notepratique2 = $data['NOTE'];
					}else if ($data['CODE_DISCIPLINE']==2){
						$notetheorie2 = $data['NOTE'];
					}else if ($data['CODE_DISCIPLINE']==3){
						$noteassiduite2 = $data['NOTE'];
					}else if ($data['CODE_DISCIPLINE']==4){
						$noteinsertion2 = $data['NOTE'];
					}//else if ($data['CODE_DISCIPLINE']==4)
				}//while($data = mysql_fetch_array($req)):pour conserver les notes correspondant aux différentes disciplines
				
				mysql_free_result($req);
			?>
			<form method="post" action="noteUpdateTraitement.php">
				<fieldset>
					<legend>Fiche de remplissage des notes</legend>
						<label for="stagiaire">Stagiaire : <?php echo $nom.' '.$prenom; ?></label>
						<input type="checkbox" name="reference" value="<?php echo $ref_stagiaire; ?>" id="stagiaire" checked required /><br/><br/>
						
						<label for="prat">Pratique : </label>
						<input type="number" step=0.25 min=0 max=20 name="pratique" value="<?php echo $notepratique2 ;?>"  id="prat" required /><br/><br/>
						
						<label for="theo">Théorie : </label>
						<input type="number" step=0.25 min=0 max=20 name="theorie" value="<?php echo $notetheorie2 ;?>" id="theo" required /><br/><br/>
						
						<label for="ass">Assiduité : </label>
						<input type="number" step=0.25 min=0 max=20 name="assiduite" value="<?php echo $noteassiduite2 ;?>" id="ass" required /><br/><br/>
						
						<label for="insert">Insertion : </label>
						<input type="number" step=0.25 min=0 max=20 name="insertion" value="<?php echo $noteinsertion2 ;?>" id="insert" required /><br/><br/>
						
						<button type="submit" class="btn">Envoyer</button>
				</fieldset>
			</form>
		</section>
		<?php
			//fermeture de la connexion
			mysql_close ();
		?>
	</body>
</html>