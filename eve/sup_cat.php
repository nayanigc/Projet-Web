<?php

$page_title="Supprime une type";
include("../header.php");

if (!isset($_GET['cid'])){
    echo"<p>Erreur</p>\n";
}else if (!isset($_POST["supprimer"])&&!isset($_POST["annuler"])){
    include("del_form_cat.php");
}else if ( isset ($_POST["annuler"])){
    echo " Operation annulée";
}else{
    require("../db_config.php");
    try{
        $db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL="DELETE FROM categories WHERE cid =?";
        $cid=$_GET["cid"];
        $st= $db->prepare($SQL);
        $res= $st->execute(array($cid));
        
        if (!$res)
            echo"<p>Erreur</p>\n";
        else echo "<p>La suppression a été effectuée</p>";
            $db=null;
    }catch(PDOException $e){
        echo "Erreur SQL:".$e->getMessage();
    }
}
echo "<a href='liste_cat.php'>Revenir</a> à la liste des catégories";
include("../footer.php");
?>