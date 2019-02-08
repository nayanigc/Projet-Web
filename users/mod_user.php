<?php

$page_title="Modifier un mot de passe ";

include("../header.php");

if(!isset($_GET['uid'])){
    echo "<p>Erreur</p>\n";

}else{
	try{
		$uid = $_GET['uid'];
		require("../db_config.php");
		$db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8",$username,$password);
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$SQL ="SELECT mdp FROM users WHERE uid =:uid";
		$st=$db->prepare($SQL);
		$uid= $_GET["uid"];
	   	$st->execute(['uid'=>$uid]);
		if ($st->rowCount()==0){
    		echo"<p> Erreur dans uid </p>\n";
		}else{

			$mdp=password_hash($_POST['mdp'],PASSWORD_DEFAULT);
			if ($mdp==""){
				include("mod_form_user.php");
			}else{
				$SQL="UPDATE users SET mdp=? WHERE uid=?";
				$st = $db->prepare($SQL);
				$res = $st->execute(array($mdp,$uid));
				if (!$res)
					echo "<p>Erreur de modification</p>";
				else echo "<p>La modification a été effectuée</p>";         
			}	
		}
		$db=null;
	}catch(PDOException $e){
echo "Erreur SQL: ".$e->getMessage();
}
}
	include("liste_user.php");
//echo "<a href='liste_users.php'>Revenir</a> à la liste des users";
	include("../footer.php");
?>