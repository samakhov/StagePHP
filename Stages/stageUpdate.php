<?php 
	include_once("../fonctions/connexionDB.php");
	include_once("../fonctions/fonctionsDelete.php");
	include_once("../fonctions/fonctionsHelp.php");
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
			<?php
				$indice = false;
				if (isset($_GET['referenceStage'])){ 
					// vérification de l'authenticité de l'URL
					$sql = 'SELECT * FROM stage WHERE REFERENCE_STAGE = "'.$_GET['referenceStage'].'" ';
					$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
					$num_rows = mysql_num_rows($req);
					if ($num_rows>0){
						$indice = true;
						//$messageErreur .= "Le stage saisi existe déjà<br/>";
						//header('Location:stageSaisie.php');
					}
				}	
					//$indice = VerificationURL('REFERENCE_STAGE', 'stage', $_GET['referenceStage']);
					if ($indice){
						$sql = 'SELECT * FROM stage WHERE REFERENCE_STAGE = "'.$_GET['referenceStage'].'"';
						$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						$data = mysql_fetch_array($req);
						
						//récupération des dates sous le format jour , mois, annee
						$timeDebut = strtotime($data['DATE_DEBUT_STAGE']);
						$anneeDebut = date('Y', $timeDebut);
						$moisDebut = date('m', $timeDebut);
						$jourDebut = date('d', $timeDebut);
						
						$timeFin = strtotime($data['DATE_FIN_STAGE']);
						$anneeFin = date('Y', $timeFin);
						$moisFin = date('m', $timeFin);
						$jourFin = date('d', $timeFin);
						
						mysql_free_result($req);
				?>
						<form method="post" action="stageUpdateTraitement.php?referenceStage=<?php echo $_GET['referenceStage']; ?>">
						<fieldset>
							<legend>Informations générales du stage</legend>
								<label for="nom">Nom du stage : </label>
								<input type="text" class="input-large" name="nom" value="<?php echo $data['NOM_STAGE'];?>" id="nom" required /><br/><br/>
								<label for="dateDebut">Date début du stage : </label>
								<select name="jourDebut" class="input-mini">
								<?php
								$i=0;
								for ($i=0;$i<31;$i++){
									if ($i+1==$jourDebut){
								?>
										<option value="<?php echo $i+1; ?>" selected ><?php echo $i+1; ?></option>
								<?php
									}else{
								?>
										<option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
								<?php
									}//if ($i+1==$jourDebut): pour selectionner le jour qui était enregistré
								}//for ($i=0;$i<31;$i++):affichage du jour
								?>
								</select>&nbsp;&nbsp;
								
								<select name="moisDebut" class="input-mini">
								<?php
								$i=0;
								for ($i=0;$i<12;$i++){
									if ($i+1==$moisDebut){
								?>
										<option value="<?php echo $i+1; ?>" selected ><?php echo $i+1; ?></option>
								<?php
									}else{
								?>
										<option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
								<?php
									}//if ($i+1==$moisDebut): pour selectionner le mois qui était enregistré
								}//for ($i=0;$i<12;$i++):affichage du mois
								?>
								</select>&nbsp;&nbsp;
								
								<select name="anneeDebut" class="input-small">
								<?php
								$i=2015;
								for ($i=2015;$i<=2030;$i++){
									if ($i==$anneeDebut){
								?>
										<option value="<?php echo $i; ?>" selected ><?php echo $i; ?></option>
								<?php
									}else{
								?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php
									}//if ($i==$anneeDebut): pour selectionner l'annee qui était enregistré
								}//for ($i=2015;$i<=2030;$i++):affichage de l'annee
								?>
								</select><br/><br/>
								
								
								<label for="dateFin">Date fin du stage : </label>
								<select name="jourFin" class="input-mini">
								<?php
								$i=0;
								for ($i=0;$i<31;$i++){
									if ($i+1==$jourFin){
								?>
										<option value="<?php echo $i+1; ?>" selected ><?php echo $i+1; ?></option>
								<?php
									}else{
								?>
										<option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
								<?php
									}//if ($i+1==$jourFin): pour selectionner le jour qui était enregistré
								}//for ($i=0;$i<31;$i++):affichage du jour
								?>
								</select>&nbsp;&nbsp;
								
								<select name="moisFin" class="input-mini">
								<?php
								$i=0;
								for ($i=0;$i<12;$i++){
									if ($i+1==$moisFin){
								?>
										<option value="<?php echo $i+1; ?>" selected ><?php echo $i+1; ?></option>
								<?php
									}else{
								?>
										<option value="<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
								<?php
									}//if ($i+1==$moisFin): pour selectionner le mois qui était enregistré
								}//for ($i=0;$i<12;$i++):affichage du mois
								?>
								</select>&nbsp;&nbsp;
								
								<select name="anneeFin" class="input-small">
								<?php
								$i=2015;
								for ($i=2015;$i<=2030;$i++){
									if ($i==$anneeFin){
								?>
										<option value="<?php echo $i; ?>" selected ><?php echo $i; ?></option>
								<?php
									}else{
								?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php
									}//if ($i==$anneeFin): pour selectionner l'annee qui était enregistré
								}//for ($i=2015;$i<=2030;$i++):affichage de l'annee
								?>
								</select><br/><br/>
								
								<label for="textarea">Commentaire du stage : </label>
								<textarea name="commentaire" id="textarea" rows="3" required ><?php echo $data['COMMENTAIRE_STAGE'];?></textarea><br/><br/><br/>
								
								<button type="submit" class="btn span2 offset2">Envoyer</button>
						</fieldset>
						</form>
				
				<?php
					}else{
						header('Location:../index.php');
					}
				?>
		</section>
	</body>
</html>