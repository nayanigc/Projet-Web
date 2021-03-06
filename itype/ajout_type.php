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
        $db=new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL="SELECT nom FROM itypes WHERE nom =?";
        $st = $db->prepare($SQL);
        $res = $st->execute(array($nom));
        if ($st->rowCount()==0){
            $SQL = "INSERT INTO itypes  VALUES (DEFAULT,?)";
            $st = $db->prepare($SQL);
            $res = $st->execute(array($nom));

			if (!$res){ 
			   echo "Erreur d’ajout";
			 } else{
				 echo "L'ajout a été effectué";
			 } 
        }else {
          echo $nom." existe deja";
        }
echo "<a href='liste_type.php'>Revenir</a> à la page de gestion";

 $db=null;
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
        }
    }
}
include("../footer.php");
?>
