<?php
session_start();

$page_title="Ajouter une id";
include("../header.php");

if(!isset($_POST['nomType'])){
    echo "NOM TYPE";
}
if(!isset($_POST['valeur'])){
    echo "VALEUR";    
} 
if(!isset($_GET['pid'])){
    echo "PID"; 
    //include("ajout_form_id.php");
} else {
    $nomType=$_POST['nomType'];
    $valeur=$_POST['valeur'];
    $pid = $_GET['pid'];
    if ($type =="" || $valeur="") {  
        include("ajout_form_id.php");
    } else {
     
        require("../db_config.php");

        try{
            $db=new PDO("mysql:host=$hostname;dbname=$dbname",$username);
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $SQL="SELECT nom,tid FROM itypes WHERE nom = ?";
            $st = $db->prepare($SQL);
            $res = $st->execute(array($nomType));
            
            if(!$res){
                $SQL = "INSERT INTO identification VALUES (?,DEFAULT,?)";
                $st = $db->prepare($SQL);
                $res = $st->execute(array($pid,$nomType,$valeur));
                echo "L'ajout a été effectué";
            }else{
               echo $type." existe déjà"; 
            }
            echo "<a href='../home.php'>Revenir</a> à la page de gestion";

            $db=null;
        }catch (PDOException $e){
            echo "Erreur SQL: ".$e->getMessage();
        }
    }
}
include("../footer.php");
?>
