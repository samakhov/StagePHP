<?php

function UpdateStage($nv_nom, $nv_dateDebut, $nv_dateFin, $nv_commentaire, $ref){
	$sql = 'UPDATE stage SET NOM_STAGE = "'.$nv_nom.'",
	DATE_DEBUT_STAGE = "'.$nv_dateDebut.'", DATE_FIN_STAGE = "'.$nv_dateFin.'", COMMENTAIRE_STAGE = "'.$nv_commentaire.'" WHERE REFERENCE_STAGE = "'.$ref.'"';
	mysql_query($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
}

function UpdateStagiaire($nv_nom, $nv_prenom, $nv_date, $nvsexe, $nv_adresse, $nv_code, $nv_ville, $nv_perso, $nv_service, $nv_portable,$nv_stage, $nv_nat,
	$nv_commentaire, $ref){
	$sql = 'UPDATE stagiaire SET NOM_STAGIAIRE = "'.$nv_nom.'", PRENOM_STAGIAIRE= "'.$nv_prenom.'", DATE_NAISS = "'.$nv_date.'",
	SEXE_STAGIAIRE = "'.$nvsexe.'", ADRESSE_STAGIAIRE = "'.$nv_adresse.'", CODEPOSTAL_STAGIAIRE = "'.$nv_code.'", VILLE_STAGIAIRE = "'.$nv_ville.'", 
	TELEPHONE_PERSONNEL = "'.$nv_perso.'", TELEPHONE_SERVICE = "'.$nv_service.'", TELEPHONE_PORTABLE = "'.$nv_portable.'", 
	REFERENCE_STAGE = "'.$nv_stage.'", CODE_NATIONALITE = "'.$nv_nat.'",COMMENTAIRE_STAGIAIRE = "'.$nv_commentaire.'"
	WHERE REFERENCE_STAGIAIRE = "'.$ref.'" ';
	$req = mysql_query($sql) or die ('Erreur SQL !'.$req.'<br />'.mysql_error());
}

function UpdateNationalite($nv_nationalite, $ref){
	$sql = 'UPDATE nationalite SET NATIONALITE = "'.$nv_nationalite.'" WHERE CODE_NATIONALITE = "'.$ref.'"';
	mysql_query($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
}

function UpdateNote($nv_note, $refdiscipline, $refstagiaire){
	$sql = 'UPDATE note SET NOTE = "'.$nv_note.'" WHERE CODE_DISCIPLINE = "'.$refdiscipline.'" AND REFERENCE_STAGIAIRE = "'.$refstagiaire.'"';
	mysql_query($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
}

?>