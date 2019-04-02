<?php
if(!empty($_REQUEST["nimi"])){
	$nimi = $_REQUEST['nimi'];
	$db = new PDO('sqlite:Mobiili.sqlite');
	$sql  = "SELECT * FROM Kayttajat WHERE Nimi='$nimi'";
	$result = $db->query($sql);
	if($result->fetch()){
		$db->exec("DELETE FROM Kayttajat WHERE Nimi='$nimi';");
		$result=null;
		$db=null;
	}else{
		$db=null;
		
	}		
}

?> 