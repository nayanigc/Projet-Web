<?php

$page_title="Modifier le nom et le prenom de la personne ";

include("../header.php");

if(!isset($_GET['pid'])){
    echo "<p>Erreur</p>\n";

}else{
    try{
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];      
    $pid = $_GET['pid'];
    require("../db_config.php");
    $db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8",$username,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $SQL ="SELECT nom,prenom FROM personnes WHERE pid =:pid";
        $st=$db->prepare($SQL);
        $pid= $_GET["pid"];
    $st->execute(['pid'=>$pid]);
    if ($st->rowCount()==0){
        echo"<p> Erreur dans pid </p>\n";
    }else{
           $SQL="UPDATE personnes SET nom=?,prenom=? WHERE pid=?";
            $st = $db->prepare($SQL);
            $res = $st->execute(array($nom,$prenom,$pid));
        if (!$res)
            echo "<p>Erreur de modification</p>";
       else echo "<p>La modification a été effectuée</p>";         
        }
    
    $db=null;
    }catch(PDOException $e){
    echo "Erreur SQL: ".$e->getMessage();
    }
}
echo "<a href='home.php'>Revenir</a> à la page d'accueil";
include("../footer.php");
?>