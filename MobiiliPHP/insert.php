<?php
if(!empty($_REQUEST["nimi"])){
	$kayttaja = $_REQUEST['kayttaja1'];
	$nimi = $_REQUEST['nimi'];
	$salasana = $_REQUEST['pwd1'];
	$nimi = str_replace("'","''",$nimi); 
	$nimi = str_replace("<","",$nimi); 
	$db = new PDO('sqlite:Mobiili.sqlite');
	$sql  = "SELECT * FROM Kayttajat WHERE Nimi='$nimi' AND Kayttaja_id='$kayttaja'";
	$result = $db->query($sql);
	if($result->fetch()){
		echo("Tulos on jo kannassa!");
		$result=null;
		$db=null;
	}else{
		$db->exec("INSERT INTO Kayttajat(Kayttaja_id, Nimi, Salasana) VALUES('$kayttaja', '$nimi', '$salasana')");
		echo("Rekisteroity onnistuneesti!");
		$db=null;
	}		
}

?> 