<?php

$page_title="Ajouter une id";
include("../header.php");

if(!isset($_POST['valeur'])){
        include("ajout_form_id.php");
}

if(!isset($_GET['pid'])){
    echo "PID"; 
    //include("ajout_form_id.php");
} else {
    $pid = $_GET['pid'];
    $tid = $_POST['tid'];
    $valeur=$_POST['valeur'];
}
    if (($valeur=="")) {  
        include("ajout_form_id.php");
    } else {
    
     
        require("../db_config.php");

        try{
            $db=new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $SQL="SELECT  itypes.nom as nomType
            FROM identifications
            INNER JOIN personnes ON identifications.pid = personnes.pid
            INNER JOIN itypes ON identifications.tid = itypes.tid
            WHERE itypes.tid=? AND personnes.pid=?";
            $st = $db->prepare($SQL);
            $res = $st->execute(array($tid,$pid));
            
            if($st->rowCount()==0){
                $SQL = "INSERT INTO identifications VALUES (?,?,?)";
                $st = $db->prepare($SQL);
                $res = $st->execute(array($pid,$tid,$valeur));
                echo "L'ajout a été effectué";
            }else {
                $row = $st->fetch();
               echo $row['nomType']." existe déjà"; 
        
            }
            echo "<a href='../home.php'>Revenir</a> à la page de gestion";

            $db=null;
        }catch (PDOException $e){
            echo "Erreur SQL: ".$e->getMessage();
        }
    }

include("../footer.php");
?>
