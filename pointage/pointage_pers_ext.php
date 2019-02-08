<?php
include("../header.php");
require("../db_config.php");

if(!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['tid']) || 
   !isset($_POST['valeur']) || !isset($_GET['eid']) || !isset($_GET['uid'])){
	echo "Erreur de pointage, retourner au menu Home ";
			echo "<a href='../home.php'>Retour</a>";
} else {
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$tid = $_POST['tid'];
	$valeur = $_POST['valeur'];
	$eid = $_GET['eid'];  
	$uid= $_GET['uid'];
	$date= date("Y-m-d H:i:s");

	try {
		$db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
		$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$db->beginTransaction();

		$success = true;
		
		$SQL = "INSERT INTO personnes VALUES (DEFAULT, ?, ?)";
		$st = $db->prepare($SQL);
		$res = $st->execute([$nom, $prenom]);
		if(!$res) $success = false;
		
		$pid = $db->lastInsertId();
		
		$SQL = "INSERT INTO identifications VALUES (?, ?, ?)";
		$st = $db->prepare($SQL);
		$res = $st->execute(array($pid,$tid,$valeur));
		if(!$res) $success = false;
		
		$SQL = "INSERT INTO inscriptions VALUES (?, ?, ?)";
		$st = $db->prepare($SQL);
		$res = $st->execute([$pid, $eid, $uid]);
		if(!$res) $success = false;
		
		$SQL = "INSERT INTO participations VALUES (DEFAULT, ?, ?, ?, ?)";
		$st = $db->prepare($SQL);
		$res = $st->execute([$eid, $pid, $date, $uid]);
		if(!$res) $success = false;
		
		if (!$success){
			$db->rollBack();
			echo "Erreur de pointage, retourner à la page de l'évènement";
			echo "<a href='pers_pointage.php?eid=" . $eid . "'>Retour</a>";
		} else {
			$db->commit();
			echo "pointage réussi, retourner à la page de l'évenement: ";
			echo "<a href='pers_pointage.php?eid=" . $eid . "'>Retour</a>";
		} 

		$db=null;
	}catch (PDOException $e){
		$db->rollBack();
	  echo "Erreur SQL: ".$e->getMessage();
	}
}

include("../footer.php");