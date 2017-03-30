<?php

$page_title="Modifier le nom type";

include("../header.php");

if(!isset($_GET['tid'])){
    echo "<p>Erreur</p>\n";

}else{
    try{
    $nom = $_POST['nom'];   
    $tid = $_GET['tid'];
    require("../db_config.php");
    $db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8",$username,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $SQL ="SELECT nom FROM itypes WHERE tid =:tid";
        $st=$db->prepare($SQL);
        $tid= $_GET['tid'];
    $st->execute(['tid'=>$tid]);
    if ($st->rowCount()==0){
        echo"<p> Erreur dans tid </p>\n";
    }else{
           $SQL="UPDATE itypes SET nom=? WHERE tid=?";
            $st = $db->prepare($SQL);
            $res = $st->execute(array($nom,$tid));
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