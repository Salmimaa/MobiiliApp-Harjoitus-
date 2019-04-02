<?php
if(!empty($_REQUEST['id'])){
	$db = new PDO('sqlite:Mobiili.sqlite');
	$nimi = $_REQUEST['pelaaja'];
	$id = $_REQUEST['id'];
	$hae = $_POST['heitto'];
	$vaylat = json_decode($hae, true);
	$sql  = "SELECT Kayttaja_id FROM Kayttajat WHERE Nimi='$nimi'";
	$result = $db->query($sql);
	$nimiId = $result->fetch();
	$nimi1 = $nimiId['Kayttaja_id'];
	$db->exec("INSERT INTO Pelit(Kayttaja_id, Rata_id) VALUES('$nimi1','$id');");

	$peliId = $db->lastInsertId();

	$sql1  = "SELECT Vayla_id FROM Radanvaylat WHERE Rata_id='$id'";
	$sth = $db->query($sql1);
	$result1 = $sth->fetchAll(\PDO::FETCH_ASSOC);
	$arrlength = count($result1);

	$count = 0;
	foreach ($vaylat as $x) {
			$heitto = $x['value'];
			$vaylaid = $result1[$count]['Vayla_id'];
			$db->exec("INSERT INTO Heitot(Vayla_id, lkm, Peli_id) VALUES('$vaylaid', '$heitto', '$peliId');");
			$count++;	
		}

	//	$result=null;
	//	$db=null;
		}else{

		}		

?> 