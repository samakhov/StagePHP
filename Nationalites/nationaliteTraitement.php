<?php 
	include_once("../fonctions/connexionDB.php");
	include_once("../fonctions/fonctionsInsert.php");
	include_once("../fonctions/fonctionsUpdate.php");
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
		<header>
		
		<section>
			<?php
			
				if (isset($_GET['codeNationalite']) AND isset($_POST['nationalite'])){
					UpdateNationalite(strtoupper($_POST['nationalite']), $_GET['codeNationalite']);
				}
				else if (isset($_POST['nationalite'])){
					InsertNationalite(strtoupper($_POST['nationalite']));
				}
				
				header('Location:nationalite.php');
			?>
		</section>
	</body>
</html>