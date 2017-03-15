<?php
session_start();

$page_title="Ajouter un utilisateur supplementaire";
include("header.php");

if((!isset($_POST['login']))||(!isset($_POST['mdp']))){
    include("liste_users.php");
    
}else{
    $uid = intval($_SESSION['uid']); 
    $login=$_POST['login'];
    $mdp=password_hash($_POST['mdp'],PASSWORD_DEFAULT); // hash du mot de passe pour pouvoir se connecte avec le bon mot de passe.....
    $role='user';
   
if ($login=="") {  
    include("liste_users.php");
} else {

 require("db_config.php");
    try{
        $db=new PDO("mysql:host=$hostname;dbname=$dbname",$username);
        $db-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL = "INSERT INTO users VALUES (DEFAULT,?,?,?)";
        $st = $db->prepare($SQL);
        $res = $st->execute(array($login, $mdp,$role));
    

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
include("footer.php");
?>
