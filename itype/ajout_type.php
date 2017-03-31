<?php
session_start();

$page_title="Ajouter une type";
include("../header.php");

if(!isset($_POST['nom'])){
    include("ajout_form_type.php");
    

}else{
    $nom=$_POST['nom'];
if ($nom=="") {  
    include("ajout_form_type.php");
} else {

 require("../db_config.php");
    try{
        $db=new PDO("mysql:host=$hostname;dbname=$dbname",$username);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL="SELECT nom FROM itypes WHERE nom =?";
        $st = $db->prepare($SQL);
        $res = $st->execute(array($nom));
        if ($st->rowCount()==0){
            $SQL = "INSERT INTO itypes  VALUES (DEFAULT,?)";
            $st = $db->prepare($SQL);
            $res = $st->execute(array($nom));
        }else {
          echo $nom." existe deja";
        }

 if (!$res) 
   echo "Erreur d’ajout";
   else echo "L'ajout a été effectué";
echo "<a href='../home.php'>Revenir</a> à la page de gestion";

 $db=null;
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
        }
    }
}
include("../footer.php");
?>
