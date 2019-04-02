<?php
if(!empty($_REQUEST['pelaaja'])){

	$array1 = array();
	$db = new PDO('sqlite:Mobiili.sqlite');
	$nimi = $_REQUEST['pelaaja'];

	$sql  = "SELECT Kayttaja_id FROM Kayttajat WHERE Nimi='$nimi'";
	$result = $db->query($sql);
	$a = $result->fetch();
	$kayttaja = $a['Kayttaja_id'];

	$sql  = "SELECT * FROM Pelit WHERE Kayttaja_id='$kayttaja'";
	$result = $db->query($sql);
	$pelit = $result->fetchAll(\PDO::FETCH_ASSOC);

	foreach ($pelit as $x) {
		$lkm = 0;
		$sum = 0;
		$rataNimi = NULL;

		$rataid = $x['Rata_id'];
		$peliid = $x['Peli_id'];
	
		$sql3  = "SELECT Ratanimi FROM Radat WHERE Rata_id='$rataid'";
		$result3 = $db->query($sql3);
		$rata = $result3->fetch();
		$rataNimi = $rata['Ratanimi'];

		$sql1  = "SELECT * FROM Heitot WHERE Peli_id='$peliid'";
		$sth = $db->query($sql1);
		$result1 = $sth->fetchAll(\PDO::FETCH_ASSOC);

			foreach($result1 as $z){
				$lkm = $lkm + $z['lkm'];
				$vaylaid = $z['Vayla_id'];

				$sql2  = "SELECT * FROM Vaylat WHERE Vayla_id='$vaylaid'";
				$sth1 = $db->query($sql2);
				$result2 = $sth1->fetchAll(\PDO::FETCH_ASSOC);

					foreach($result2 as $c){
						$sum = $sum + $c['par'];
					}
						
			}
			$object = (object) ['ratanimi' => $rataNimi,
								'lkm' => $lkm,
								'sum' => $sum ];
			array_push($array1, $object);
		}
		echo json_encode($array1);
		}else{
			echo("Ei pelaaja id:tä");
		}		

?> 