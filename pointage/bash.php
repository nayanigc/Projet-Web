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

if (isset($_POST['checkbox'])){
    $tabCheckbox = $_POST['checkbox'];
        foreach ($tabCheckbox as $checkbox) {
            
            $pid = addslashes($checkbox);
            
            $db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $SQL = "INSERT INTO participations VALUES (DEFAULT,?,?,?,?)";
    
            $st = $db->prepare($SQL);
            $res = $st->execute(array($eid, $pid, $date, $uid));

            if (!$res) echo "Erreur de pointage";
        }
    } else echo "erreur";
	
$db=null;
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
include("../footer.php");