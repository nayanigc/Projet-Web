<?php
session_start();
include("../header.php");

if(!isset($_POST['date'])){
        include("ajout_form_part.php");
}
  
if(!isset($_GET['pid'])){
    echo "PID"; 
    //include("ajout_form_id.php");
} else {
    $pid = $_GET['pid'];
    $eid = $_POST['eid'];
    $uid = $_POST['uid'];
    $ptid = $_POST['ptid'];
	$date= $_POST['date'];
}
    if (($date=="")) {  
        include("ajout_form_part.php");
    } else {
    
     
        require("../db_config.php");

        try{
            $db=new PDO("mysql:hostname=$hostname;dbname=$dbname",$username);
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $SQL="SELECT nom, prenom, evenements
           FROM participations INNER JOIN users on participations.uid=users.uid INNER JOIN personnes ON participations.pid = personnes.pid INNER JOIN evenements  on participations.eid = evenements.eid
            WHERE participartion.eid =? AND personnes.pid=?";
            $st = $db->prepare($SQL);
            $res = $st->execute(array($eid,$pid));
            
            if($st->rowCount()==0){
                $SQL = "INSERT INTO identifications VALUES (DEFAULT,?,?,?)";
                $st = $db->prepare($SQL);
                $res = $st->execute(array($ptid,$eid,$pid,$date,$uid));
                echo "L'ajout a été effectué";
            }else {
                $row = $st->fetch();
               echo $row['eid']." existe déjà"; 
        
            }
            echo "<a href='../home.php'>Revenir</a> à la page de gestion";

            $db=null;
        }catch (PDOException $e){
            echo "Erreur SQL: ".$e->getMessage();
        }
    }

include("../footer.php");
?>