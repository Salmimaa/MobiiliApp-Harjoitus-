<?php
try{	
	$db = new PDO('sqlite:Mobiili.sqlite');	
	$kayttaja = $_REQUEST['kayttaja'];
	$pwd = $_REQUEST['pwd'];
	$sql  = "SELECT Nimi FROM Kayttajat WHERE Kayttaja_id='$kayttaja' AND Salasana='$pwd'";
	$array = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);	
	echo json_encode($array);
}catch(PDOException $e){
	echo("Ei ok!" . $e);
}
$db=null;
?> 