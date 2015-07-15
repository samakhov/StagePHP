<?php 
	include_once("../fonctions/connexionDB.php");
	ConnexionDB();
?>
<?php

function InsertStage($nom, $dateDebut, $dateFin, $commentaire){
	$sql = 'INSERT INTO stage(NOM_STAGE, DATE_DEBUT_STAGE, DATE_FIN_STAGE, COMMENTAIRE_STAGE) VALUES("'.$nom.'", "'.$dateDebut.'", "'.$dateFin.'", "'.$commentaire.'")';
	$req = mysql_query($sql) or die ('Erreur SQL !'.$req.'<br />'.mysql_error());
}

function InsertStagiaire($nom, $prenom, $dateNaiss, $sexe, $adresse, $codePoste, $ville, $perso, $service, $portable, $ref, $codenat, $commentaires){
	$sql = 'INSERT INTO stagiaire(NOM_STAGIAIRE, PRENOM_STAGIAIRE, DATE_NAISS, SEXE_STAGIAIRE, ADRESSE_STAGIAIRE, CODEPOSTAL_STAGIAIRE,
	VILLE_STAGIAIRE, TELEPHONE_PERSONNEL, TELEPHONE_SERVICE, TELEPHONE_PORTABLE, COMMENTAIRE_STAGIAIRE,REFERENCE_STAGE, CODE_NATIONALITE, DATE_CREATIONFICHE_STAGIAIRE) 
	VALUES("'.$nom.'", "'.$prenom.'", "'.$dateNaiss.'", "'.$sexe.'", "'.$adresse.'", "'.$codePoste.'", "'.$ville.'", "'.$perso.'", "'.$service.'",
	"'.$portable.'", "'.$commentaires.'", "'.$ref.'", "'.$codenat.'", NOW())';
	$req = mysql_query($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
}


function InsertNationalite($nationalite){
	$sql = 'INSERT INTO nationalite(NATIONALITE) VALUES("'.$nationalite.'")';
	$req = mysql_query($sql) or die ('Erreur SQL !'.$req.'<br />'.mysql_error());
}

function InsertNote($reference, $note, $code){
	$sql = 'INSERT INTO note(REFERENCE_STAGIAIRE, NOTE, CODE_DISCIPLINE) VALUES("'.$reference.'", "'.$note.'", "'.$code.'")';
	$req = mysql_query($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
}

?>