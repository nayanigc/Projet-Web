<?php

$page_title="Modifier";

include("../header.php");

if(!isset($_GET['eid'])){
    echo "<p>Erreur</p>\n";

}else{
    try{
    $eid = $_GET['eid'];
  $cid = $_POST['cid'];
$intitule= $_POST['intitule'];
$description = $_POST['description'];
$dateDebut = $_POST['datedebut'];
$dateFin = $_POST['datefin'];
$type = $_POST['type'];   
    require("../db_config.php");
    $db = new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $SQL="SELECT * FROM evenements WHERE  eid=:eid";
        $st=$db->prepare($SQL);
    $st->execute(['eid'=>$eid]);
    if ($st->rowCount()==0){
        echo"<p> Erreur dans eid </p>\n";
    }else{
           $SQL="UPDATE evenements SET intitule=?,description=?,dateDebut=?,dateFin=?,type=?,cid=? WHERE eid=? ";
            $st = $db->prepare($SQL);
            $res = $st->execute(array($intitule,$description,$dateDebut,$dateFin,$type,$cid,$eid));
        if (!$res)
            echo "<p>Erreur de modification</p>";
       else echo "<p>La modification a été effectuée</p>";         
        }
    
    $db=null;
    }catch(PDOException $e){
    echo "Erreur SQL: ".$e->getMessage();
    }
}
echo "<a href='../home.php'>Revenir</a> à la page d'accueil";
include("../footer.php");
?>