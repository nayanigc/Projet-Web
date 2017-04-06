<?php

$page_title="Modifier le nom type";

include("../header.php");

if(!isset($_GET['cid'])){
    echo "<p>Erreur</p>\n";

}else{
    try{
    $nom = $_POST['nom'];   
    $cid = $_GET['cid'];
    require("../db_config.php");
    $db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8",$username,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $SQL ="SELECT nom FROM categories WHERE cid =:cid";
        $st=$db->prepare($SQL);
    $st->execute(['cid'=>$cid]);
    if ($st->rowCount()==0){
        echo"<p> Erreur dans cid </p>\n";
    }else{
           $SQL="UPDATE categories SET nom=? WHERE cid=?";
            $st = $db->prepare($SQL);
            $res = $st->execute(array($nom,$cid));
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