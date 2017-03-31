


<?php
session_start();
//TODO faire une recuperation de tid qui va permettre dajoute ou pas un nom
$page_title="Ajouter une id";
include("../header.php");

if(!isset($_POST['valeur'])){
        include("ajout_form_id.php");
}else{
}
if(!isset($_GET['tid'])){
    echo "TID"; 
}
if(!isset($_GET['pid'])){
    echo "PID"; 
    //include("ajout_form_id.php");
} else {
    $pid = $_GET['pid'];
}
    if (($valeur="")) {  
        include("ajout_form_id.php");
    } else {
     
        require("../db_config.php");

        try{
            $db=new PDO("mysql:host=$hostname;dbname=$dbname",$username);
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $SQL="SELECT personnes.nom as nomPersonne, prenom, itypes.nom as nomType, valeur
        FROM identifications
        INNER JOIN personnes ON identifications.pid = personnes.pid
        INNER JOIN itypes ON identifications.tid = itypes.tid
        WHERE itypes.nom=?";
            $st = $db->prepare($SQL);
            $res = $st->execute(array($nom));
            
            if($st->rowCount()==0){
                $SQL = "INSERT INTO identifications VALUES (?,?,?)";
                $st = $db->prepare($SQL);
                $res = $st->execute(array($pid,,$valeur));
                echo "L'ajout a été effectué";
            }else if ($pid){
               echo $nomType." existe déjà"; 
        
            }
            echo "<a href='../home.php'>Revenir</a> à la page de gestion";

            $db=null;
        }catch (PDOException $e){
            echo "Erreur SQL: ".$e->getMessage();
        }
    }

include("../footer.php");
?>
