<?php 
function ConnexionDB(){
	$bdd = mysql_connect('localhost', 'root', '');
	mysql_select_db('devoir',$bdd);
}

?>