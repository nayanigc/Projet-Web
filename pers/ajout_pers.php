<?php


$page_title="Ajouter une personne";
include("../header.php");

if((!isset($_POST['nom'])) || (!isset($_POST['prenom'])) || $_POST['nom'] === "" || $_POST['prenom'] === ""){
    include("liste_pers.php");
}else{
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    
if (($nom=="") || ($prenom=="")) {  
    include("liste_pers.php");
} else {
?>

<?php
 require("../db_config.php");
    try{
        $db=new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL = "INSERT INTO personnes VALUES (DEFAULT,?,?)";
        $st = $db->prepare($SQL);
        $res = $st->execute(array($nom, $prenom));
    

 if (!$res) 
   echo "Erreur d’ajout";
   else echo "L'ajout a été effectué";
echo "<a href='liste_pers.php'>Revenir</a> à la page de gestion";

 $db=null;
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
        }
    }
}
include("../footer.php");
?>
