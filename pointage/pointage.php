<?php
include("../header.php");
require("../db_config.php");

//echo "Avec un formulaire, envoyer le eid et le pid depuis la page de pers_pointage pour l'inserer dans la table participation";

$eid = $_GET['eid'];  
$uid= $_GET['uid'];
$date= date("Y-m-d H:i:s");
$pid= $_GET['pid'];

try {
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$SQL2="INSERT INTO participations VALUES (DEFAULT,?,?,?,?)";
$st2 = $db->prepare($SQL2);
$res = $st2->execute(array($eid,$pid,$date,$uid));
	
	
if (!$res) echo "erreur de pointage";
else echo "pointage réussi";

$db=null;
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
include("../footer.php");