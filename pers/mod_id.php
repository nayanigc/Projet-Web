<?php

$page_title="Modifier le nom type";

include("../header.php");

if(!isset($_GET['tid'])){
    echo "<p>Erreur</p>\n";

}else{
    try{
 //   $pid = $_GET['pid'];
    $tid = $_GET['tid'];
    $valeur = $_POST['valeur'];   
    require("../db_config.php");
    $db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8",$username,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $SQL ="SELECT valeur FROM identifications WHERE tid =:tid";
        $st=$db->prepare($SQL);
        $tid= $_GET['tid'];
    $st->execute(['tid'=>$tid]);
    if ($st->rowCount()==0){
        echo"<p> Erreur dans tid </p>\n";
    }else{
           $SQL="UPDATE identifications SET valeur=? WHERE tid=?";
            $st = $db->prepare($SQL);
            $res = $st->execute(array($valeur,$tid));
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