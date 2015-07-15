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
			</header>
			
			<section>
				<?php
					/*$req = $bdd->query('SELECT * FROM stagiaire  
					ON s.Codenationalite = n.CodeNationalite');
					while($reqanswer = $req->fetch()){
						echo '<tr>
								<td><input type="checkbox" name="1"></td>
								<td>'.$reqanswer['nom'] $reqanswer['prenom'].'</td>
								<td>'.33 ans.'</td>
								<td>'.Espagne.'</td>
								<td>'.Espagne.'</td>
							</tr>';
					}
					$req->closeCursor();*/
				?>
					<article>
						<form method="post" action="nationaliteAffiche.php">
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
						</select><br /><br />
						<input type="submit" align="center" value="Voir les Stagiaires"/>
						</form>
						
						<?php 
							//$sql = 'SELECT * FROM nationalite';
							//$reqn = mysql_query($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
							//while($data = mysql_fetch_array($reqn)){
						?>	
					
						<?php
							//}
						?>	
					</article>
			</section>
	</body>
</html>