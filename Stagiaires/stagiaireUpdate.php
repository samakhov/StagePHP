<?php include_once("../fonctions/connexionDB.php");
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
			<?php include_once("../includes/menu.php"); ?>
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
				
				//$indice= VerificationURL('REFERENCE_STAGIAIRE', 'stagiaire' , $_GET['referenceStagiaire']);
				
				if ($indice == 1){
					$sql = 'SELECT * FROM stagiaire WHERE REFERENCE_STAGIAIRE = "'.$_GET['referenceStagiaire'].'"';
					$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
					$datastagiaire = mysql_fetch_array($req);
					
					//récupération des dates sous le format jour , mois, annee
					$timeNaiss = strtotime($datastagiaire['DATE_NAISS']);
					$annee = date('Y', $timeNaiss);
					$mois = date('m', $timeNaiss);
					$jour = date('d', $timeNaiss);
					
					mysql_free_result($req);
				
			?>
			<form method="post" action="stagiaireUpdateTraitement.php?referenceStagiaire=<?php echo $_GET['referenceStagiaire']; ?>">
				<fieldset>
					<legend>Identité du stagiaire</legend>
						<label for="nom">Nom : </label>
						<input type="text" name="nom" value="<?php echo $datastagiaire['NOM_STAGIAIRE']; ?>" id="nom" required /><br/><br/>
						
						<label for="prenom">Prénoms : </label>
						<input type="text" name="prenom" value="<?php echo $datastagiaire['PRENOM_STAGIAIRE']; ?>" id="prenom" required /><br/><br/>
						
						<label for="nationalite">Nationalité : </label>
						<select name="nationalite">
						<?php
						$sql = 'SELECT CODE_NATIONALITE, NATIONALITE FROM nationalite';
						$reqn = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						while($data=mysql_fetch_array($reqn)){
							if ($data['CODE_NATIONALITE']==$datastagiaire['CODE_NATIONALITE']){
						?>
								<option value="<?php echo $data['CODE_NATIONALITE']; ?>" selected><?php echo $data['NATIONALITE']; ?></option>
						<?php
							}else{
						?>
								<option value="<?php echo $data['CODE_NATIONALITE']; ?>"><?php echo $data['NATIONALITE']; ?></option>
						<?php
							}//if ($data['CODE_NATIONALITE']==$datastagiaire['CODE_NATIONALITE']):selectionner la notionlité qui avait été enregistrer
						}//while($data=mysql_fetch_array($reqn)):afficher les nationalites disponibles
						mysql_free_result ($reqn);
						?>
						</select><br/><br/>
						
						<label for="dateNaiss">Date de Naissance : </label>
						<select name="jour" class="input-mini">
						<?php
						$i=0;
						for ($i=0;$i<31;$i++){
							if ($i+1==$jour){
						?>
								<option value="<?php echo $i+1; ?>" selected ><?php echo $i+1; ?></option>
						<?php
							}else{
						?>
								<option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
						<?php
							}//if ($i+1==$jour): pour selectionner le jour qui était enregistré
						}//for ($i=0;$i<31;$i++):affichage du jour
						?>
						</select>&nbsp;&nbsp;
						<select name="mois" class="input-mini">
						<?php
						$i=0;
						for ($i=0;$i<12;$i++){
							if ($i+1==$mois){
						?>
								<option value="<?php echo $i+1; ?>" selected ><?php echo $i+1; ?></option>
						<?php
							}else{
						?>
								<option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
						<?php
							}//if ($i+1==$mois): pour selectionner le mois qui était enregistré
						}//for ($i=0;$i<12;$i++):affichage du mois
						?>
						</select>&nbsp;&nbsp;
						<select name="annee" class="input-small">
						<?php
						$i=0;
						for ($i=2015;$i>=1980;$i--){
							if ($i==$annee){
						?>
								<option value="<?php echo $i; ?>" selected ><?php echo $i; ?></option>
						<?php
							}else{
						?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php
							}//if ($i==$annee): pour selectionner l'annee qui était enregistré
						}//for ($i=2015;$i>=1980;$i--):affichage de l'annee
						?>
						</select><br/><br/>
						
						<label>Sexe : </label>&nbsp;&nbsp;&nbsp;
						<?php
							if ($datastagiaire['SEXE_STAGIAIRE']=="M"){
						?>
								<input type="radio" name="sexe" value="M" value="<?php echo $data['SEXE_STAGIAIRE']; ?>" checked />&nbsp;&nbsp;M&nbsp;&nbsp;
								<input type="radio" name="sexe" value="F" />&nbsp;&nbsp;F<br/><br/>
						<?php
							}else{
						?>
								<input type="radio" name="sexe" value="M" value="<?php echo $data['SEXE_STAGIAIRE']; ?>" />&nbsp;&nbsp;M&nbsp;&nbsp;
								<input type="radio" name="sexe" value="F" checked />&nbsp;&nbsp;F<br/><br/>
						<?php
							}//if ($datastagiaire['SEXE_STAGIAIRE']=="M"):selectionner le sexe qui avait été enregistré
						?>
				</fieldset>
				
				<fieldset>
					<legend>Informations complémentaires</legend>
						<label for="stage">Stage : </label>
						<select name="stage">
						<?php
						$sql = 'SELECT REFERENCE_STAGE, NOM_STAGE FROM stage';
						$reqs = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						while($data=mysql_fetch_array($reqs)){
							if ($data['REFERENCE_STAGE'] == $datastagiaire['REFERENCE_STAGE']){
						?>
								<option value="<?php echo $data['REFERENCE_STAGE']; ?>" selected><?php echo $data['NOM_STAGE']; ?></option>
						<?php
							}else{
						?>
								<option value="<?php echo $data['REFERENCE_STAGE']; ?>"><?php echo $data['NOM_STAGE']; ?></option>
						<?php
							}//if ($data['REFERENCE_STAGE'] == $datastagiaire['REFERENCE_STAGE']):selectionner le stage qui avait été enregistré
						}//while($data=mysql_fetch_array($reqs)):afficher les stages disponibles
						mysql_free_result ($reqs);
						?>
						</select><br/><br/>
						
						<label for="adresse">Adresse : </label>
						<input type="text" name="adresse" id="adresse" value="<?php echo $datastagiaire['ADRESSE_STAGIAIRE']; ?>" required /><br/><br/>
						
						<label for="codePoste">Code Postal : </label>
						<input type="text" name="codePoste" value="<?php echo $datastagiaire['CODEPOSTAL_STAGIAIRE']; ?>" id="codePoste" /><br/><br/>
						
						<label for="ville">Ville : </label>
						<input type="text" name="villeStagiaire" value="<?php echo $datastagiaire['VILLE_STAGIAIRE']; ?>" id="ville" required /><br/><br/>
						
						<label for="telPerso">Téléphone Personnel : </label>
						<input type="tel" name="TelephonePersonnel" value="<?php echo $datastagiaire['TELEPHONE_PERSONNEL']; ?>" id="telPerso" required /><br/><br/>
						
						<label for="telService">Téléphone Service : </label>
						<input type="tel" name="TelephoneService" value="<?php echo $datastagiaire['TELEPHONE_SERVICE']; ?>" id="telService" required /><br/><br/>
						
						<label for="telPorte">Téléphone Portable : </label>
						<input type="tel" name="TelephonePortable" value="<?php echo $datastagiaire['TELEPHONE_PORTABLE']; ?>" id="telPorte" required /><br/><br/>
						
						<label for="textarea">Commentaire du stagiaire : </label>
						<textarea name="commentaire" id="textarea" rows="3"><?php echo $datastagiaire['COMMENTAIRE_STAGIAIRE']; ?></textarea><br/><br/><br/>
				</fieldset>
				<button type="submit" class="btn span2 offset2">Envoyer</button>
			</form>
			
			<?php
				}else{
					echo '<h4 align="center"><font color="red"> URL incorrect!<br/>  </font></h4>';
				}
				//fermeture de la connexion
				mysql_close ();
			?>
		</section>
	</body>
</html>