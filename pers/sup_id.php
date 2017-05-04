<?php

$page_title="Supprime une personne";
include("../header.php");

if ((!isset($_GET['pid']))&&(!isset($_GET['tid']))){
    echo"<p>Erreur</p>\n";
}else if (!isset($_POST["supprimer"])&&!isset($_POST["annuler"])){
    include("del_form.php");
}else if ( isset ($_POST["annuler"])){
    echo " Operation annulée";
}else{
    require("../db_config.php");
    try{ 
        $db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL="DELETE FROM identifications WHERE tid =?";
        $tid=$_GET["tid"];
        $st= $db->prepare($SQL);
        $res= $st->execute(array($tid));
        
        if (!$res)
            echo"<p>Erreur</p>\n";
        else echo "<p>La suppression a été effectuée</p>";
            $db=null;
    }catch(PDOException $e){
        echo "Erreur SQL:".$e->getMessage();
    }
}
echo "<a href='../home.php'>Revenir</a> à la page d'accueil";
include("../footer.php");
?>