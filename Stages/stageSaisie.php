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
			<!--Formulaire de saisie du stage-->
			<form method="post" action="stageTraitement.php">
				<fieldset>
					<legend>Informations générales du stage</legend>
						<label for="nom">Nom du stage : </label>
						<input type="text" class="input-large" name="nom" id="nom" placeholder="INFO2015" required /><br/><br/>
						<label for="dateNaiss">Date début du stage : </label>
						<select name="jourDebut" class="input-mini">
						<?php
						$i=0;
						for ($i=0;$i<31;$i++){
						?>
							<option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
						<?php
						}//for ($i=0;$i<31;$i++):affichage du jour
						?>
						</select>&nbsp;&nbsp;
						
						<select name="moisDebut" class="input-mini">
						<?php
						$i=0;
						for ($i=0;$i<12;$i++){
						?>
							<option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
						<?php
						}//for ($i=0;$i<12;$i++):affichage du mois
						?>
						</select>&nbsp;&nbsp;
						
						<select name="anneeDebut" class="input-small">
						<?php
						$i=0;
						for ($i=2015;$i<=2030;$i++){
						?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php
						}//for ($i=2015;$i<=2030;$i++):affichage de l'annee
						?>
						</select><br/><br/>
						
						<label for="dateFin">Date fin du stage : </label>
						<select name="jourFin" class="input-mini">
						<?php
						$i=0;
						for ($i=00;$i<31;$i++){
						?>
							<option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
						<?php
						}//for ($i=0;$i<31;$i++):affichage du jour
						?>
						</select>&nbsp;&nbsp;
						
						<select name="moisFin" class="input-mini">
						<?php
						$i=0;
						for ($i=0;$i<12;$i++){
						?>
							<option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
						<?php
						}//for ($i=0;$i<12;$i++):affichage du mois
						?>
						</select>&nbsp;&nbsp;
						
						<select name="anneeFin" class="input-small">
						<?php
						$i=0;
						for ($i=2015;$i<=2030;$i++){
						?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php
						}//for ($i=2015;$i<=2030;$i++):affichage de l'annee
						?>
						</select><br/><br/>
						
						<label for="textarea">Commentaire du stage : </label>
						<textarea name="commentaire" id="textarea" rows="4" cols="50" required >Votre commentaire</textarea><br/><br/><br/>
								
						<button type="submit" class="btn span2 offset2">Envoyer</button>
				</fieldset>
			</form>
		</section>
	</body>
</html>