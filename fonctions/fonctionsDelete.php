<?php

function DeleteStage(){
	$req = mysql_query('SELECT referenceStage FROM stages WHERE nom = "MOi"') or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$data = mysql_fetch_array($req);
	$ref = $data['referenceStage'];
	mysql_free_result ($req);
	mysql_query('DELETE FROM stages WHERE referenceStage="'.$ref.'"');
	
	mysql_query('DELETE FROM stagiaires WHERE referenceStage="'.$ref.'"');
	mysql_close();
}

function DeleteStagiaire($ref){
	$sql = 'DELETE FROM note WHERE REFERENCE_STAGIAIRE="'.$ref.'"';
	mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
	
	$sql = 'DELETE FROM stagiaire WHERE REFERENCE_STAGIAIRE="'.$ref.'"';
	mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
	
	return true;
}

?>