<?php include_once("../fonctions/connexionDB.php");
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
				if (isset($_GET['CodeNationalite'])){
					$sql = 'SELECT * FROM nationalite WHERE CODE_NATIONALITE = "'.$_GET['CodeNationalite'].'" ';
					$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
					$data = mysql_fetch_array($req);
					mysql_free_result($req);
			?>	
					<form method="post" action="nationaliteTraitement.php?codeNationalite=<?php echo $_GET['CodeNationalite']; ?>">
						<fieldset>
							<legend>Informations générales du stage</legend>
								<label for="nationalite">Nationalité : </label>
								<input type="text" name="nationalite" value="<?php echo $data['NATIONALITE']; ?>"id="nationalite" /><br/><br/>
								
								<button type="submit" class="btn">Envoyer</button>
						</fieldset>
					</form>

			<?php
				}else{
			?>
					<form method="post" action="nationaliteTraitement.php">
						<fieldset>
							<legend>Informations générales du stage</legend>
								<label for="nationalite">Nationalité : </label>
								<input type="text" name="nationalite" id="nationalite" /><br/><br/>
								
								<button type="submit" class="btn">Envoyer</button>
						</fieldset>
					</form>
			<?php
				}//if (isset($_GET['CodeNationalite']))
			?>
		</section>
	</body>
</html>