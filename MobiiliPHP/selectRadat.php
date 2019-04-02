<?php
header("Access-Control-Allow-Origin: *");

try{	
	$db = new PDO('sqlite:Mobiili.sqlite');	
	$sql  = "SELECT * FROM Radat";
	$array = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);	
	echo json_encode($array);
}catch(PDOException $e){
	echo("Ei ok!" . $e);
}
$db=null;
?> 