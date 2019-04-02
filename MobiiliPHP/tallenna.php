<?php
	$vaylat = $_POST["myArray"];
	$manage = json_decode($vaylat, true);	 
	$db = new PDO('sqlite:Mobiili.sqlite');
	$id = $manage[0]['id'];
	$nimi = $manage[0]['nimi'];
	$sql  = "SELECT * FROM Radat WHERE Rata_id='$id'";
	$arrlength = count($manage);
	$result = $db->query($sql);
		if($result->fetch()){
				echo ("Rata on jo kannassa");
				$result=null;
				$db=null;
		}else{
			$db->exec("INSERT INTO Radat VALUES('$id', '$nimi')");
			for ($x = 0; $x < $arrlength; $x++) {
				$par = $manage[$x]['par'];
				$num = $manage[$x]['numero'];
				$db->exec("INSERT INTO Vaylat (par, numero) VALUES('$par', '$num')");
				$vaylaid = $db->lastInsertId();
				$db->exec("INSERT INTO Radanvaylat (Vayla_id, Rata_id) VALUES('$vaylaid', '$id')");
			} 
			$result1=null;
			$db=null;
		}
?> 