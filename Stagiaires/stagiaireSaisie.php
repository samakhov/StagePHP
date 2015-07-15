<?php include_once("../fonctions/connexionDB.php");
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
			<?php include_once("../includes/menu.php"); ?>
		<header>
			
		<section>
			<form method="post" action="stagiaireTraitement.php">
				<fieldset>
					<legend>Identité du stagiaire</legend>
						<label for="nom">Nom : </label>
						<input type="text" placeholder="KOKOU" name="nom" id="nom" required /><br/><br/>
						
						<label for="prenom">Prénoms : </label>
						<input type="text" placeholder="Amey" name="prenom" id="prenom" required /><br/><br/>
						
						<label for="nationalite">Nationalité : </label>
						<select name="nationalite">
						<?php
						$sql = 'SELECT CODE_NATIONALITE, NATIONALITE FROM nationalite';
						$reqn = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						while($data=mysql_fetch_array($reqn)){
						?>
							<option value="<?php echo $data['CODE_NATIONALITE']; ?>"><?php echo $data['NATIONALITE']; ?></option>
						<?php
						}//while($data=mysql_fetch_array($reqn)):afficher les nationalites disponibles
						mysql_free_result ($reqn);
						?>
						</select><br/><br/>
						
						<label for="dateNaiss">Date de Naissance : </label>
						<select name="jour" class="input-mini">
						<?php
						$i=0;
						for ($i=0;$i<31;$i++){
						?>
							<option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
						<?php
						}//for ($i=0;$i<31;$i++):affichage du jour
						?>
						</select>&nbsp;&nbsp;
						<select name="mois" class="input-mini">
						<?php
						$i=0;
						for ($i=0;$i<12;$i++){
						?>
							<option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
						<?php
						}//for ($i=0;$i<12;$i++):affichage du mois
						?>
						</select>&nbsp;&nbsp;
						<select name="annee" class="input-small">
						<?php
						$i=0;
						for ($i=2015;$i>=1980;$i--){
						?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php
						}//for ($i=2015;$i>=1980;$i--):affichage de l'annee
						?>
						</select><br/><br/>
						
						<label>Sexe : </label>&nbsp;&nbsp;&nbsp;
						<input type="radio" name="sexe" value="M" checked />&nbsp;&nbsp;M&nbsp;&nbsp;
						<input type="radio" name="sexe" value="F" />&nbsp;&nbsp;F<br/><br/>
				</fieldset>
				
				<fieldset>
					<legend>Informations complémentaires</legend>
						<label for="stage">Stage : </label>
						<select name="stage">
						<?php
						$sql = 'SELECT REFERENCE_STAGE, NOM_STAGE FROM stage';
						$reqs = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						$num_rows = mysql_num_rows($reqs);
						
						if ($num_rows>0){
							while($data=mysql_fetch_array($reqs)){
						?>	
								<option value="<?php echo $data['REFERENCE_STAGE']; ?>"><?php echo $data['NOM_STAGE']; ?></option>
						
						<?php
							}//while($data=mysql_fetch_array($reqs)):afficher les stages existants
						}else{
						?>
								<option value="rien">Aucun stage</option>
						<?php
						}//if ($num_rows>0):voir s'il y a des stages ou pas
						mysql_free_result($reqv);
						mysql_free_result ($reqs);
						?>
						</select>
						<a class="btn btn-link" href="../Stages/stageSaisie.php"><i class="icon-plus-sign"></i>Ajouter Stage</a>
						<br/><br/>
						
						<label for="adresse">Adresse : </label>
						<input type="text" placeholder="123, rue des Kpokpo" name="adresse" id="adresse" placeholder="123, rue des Kpokpo" required /><br/><br/>
						
						<label for="codePoste">Code Postal : </label>
						<input type="text" placeholder="1234" name="codePoste" id="codePoste" /><br/><br/>
						
						<label for="ville">Ville : </label>
						<input type="text" placeholder="Lomé" name="villeStagiaire" id="ville" required /><br/><br/>
						
						<label for="telPerso">Téléphone Personnel : </label>
						<input type="tel" placeholder="00-00-00-00" name="TelephonePersonnel" id="telPerso" required /><br/><br/>
						
						<label for="telService">Téléphone Service : </label>
						<input type="tel" placeholder="00-00-00-00" name="TelephoneService" id="telService" required /><br/><br/>
						
						<label for="telPorte">Téléphone Portable : </label>
						<input type="tel" placeholder="00-00-00-00" name="TelephonePortable" id="telPorte" required /><br/><br/>
						
						<label for="textarea">Commentaire du stagiaire : </label>
						<textarea name="commentaire" id="textarea" rows="3">Votre commentaire</textarea><br/><br/><br/>
				</fieldset>
				<button type="submit" class="btn span2 offset2">Envoyer</button>
			</form>
			<?php
				//fermeture de la connexion
				mysql_close ();
			?>
		</section>
	</body>
</html>