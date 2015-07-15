
<?php

function Observation($note){

	$observation = "";
	if ($note<=20 AND $note>=18){
		$observation = "Excellent";
	}else if ($note>=16){
		$observation = "Très Bien";
	}else if ($note>=14){
		$observation = "Bien";
	}else if ($note>=12){
		$observation = "Assez Bien";
	}else if ($note>=10){
		$observation = "Passable";
	}else if ($note>=8){
		$observation = "Insuffisant";
	}else if ($note>=6){
		$observation = "Faible";
	}else if ($note>=4){
		$observation = "Mauvais";
	}else if ($note>=0){
		$observation = "Nul";
	}
	
	return $observation;
}

function VerificationURL($column, $table, $getvar){
	$indice = true;
	$sql = 'SELECT MAX('.$column.') AS ref_max, MIN('.$column.') AS ref_min FROM '.$table.'';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	while ($data = mysql_fetch_array($req)){
		$ref_max = $data['ref_max'];
		$ref_min = $data['ref_min'];
	}
	mysql_free_result($req);
	if (isset($getvar)){
		$getvar = (int)$getvar;
							
		if ($getvar>=$ref_min AND $getvar<=$ref_max){
			$code = $getvar;
			$ind = true;
		}else{
			$ind = false;
		}//if ($_GET['reference']>=$code_min AND $_GET['reference']<=$code_max)
	}//if (isset($_GET['reference']))
	
	return $indice;
}

function ControleNote($note){
	if($note == 0){
		echo '-';
	}else{
		echo $note;
	}
}

function VerificationTelephone($telephone){
	if (preg_match("#^[0-9]{2}([- ]?[0-9]{2}){3}$#", $telephone)){
		$indice = 0;
	}else{
		$indice = 1;
	}//if (preg_match("#^[0-9]{2}([- ]?[0-9]{2}){3}$#", $telephone))
	
	return $indice;
}								
								
?>