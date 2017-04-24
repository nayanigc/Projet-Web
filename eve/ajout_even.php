<?php
session_start();
$page_titre="Ajouter un evenement";
include("../header.php");

if(!isset($_POST['intitule'])){
	echo"titre";
}
if(!isset($_POST['description'])){
	echo"descripteur";
}
if(!isset($_POST['cid'])){
	echo"cid";
}
else {
$cid = $_POST['cid'];
$intitule= $_POST['intitule'];
$description = $_POST['description'];
$dateDebut = $_POST['datedebut'];
$dateFin = $_POST['datefin'];
$type = $_POST['type'];
 if (($intitule=="")||($description=="")){
        include("ajout_form_even.php");
 }else{
   require("../db_config.php");
   try{
   $db=new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
   $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $SQL="INSERT INTO evenements VALUES (DEFAULT,?,?,?,?,?,?)";
    $st=$db->prepare($SQL);
   $res = $st->execute(array($intitule,$description,$dateDebut,$dateFin,$type,$cid));
   echo"L'ajout a été effectué";
   echo "<a href='../home.php'>Revenir</a> à la page de gestion";

            $db=null;
       
    }catch (PDOException $e){
            echo "Erreur SQL: ".$e->getMessage();
        }
    }
}

include("../footer.php");
?>