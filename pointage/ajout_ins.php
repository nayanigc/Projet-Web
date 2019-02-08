<?php

session_start();

$page_title="Liste evenement";
include("../header.php");

require("../db_config.php");
if(!isset($_POST['pid'])){
	echo "Erreur PID";
}
if(!isset($_GET['eid'])){
 echo "erreur EID";
} else {
	$uid=$_SESSION['uid'];
	$pid=$_POST['pid'];
	$eid=$_GET['eid'];
try{
    $db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$SQL = "SELECT * FROM inscriptions WHERE pid=? AND eid=?";
	$st=$db->prepare($SQL);
	$res = $st->execute(array($pid, $eid));

	if($st->rowCount() == 0){
		   $db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$SQL="INSERT INTO inscriptions VALUES (?,?,?)";
    	$st1=$db->prepare($SQL);
		$res=$st1->execute(array($pid,$eid,$uid));
      	if($st1->rowCount()==0){
        	echo"<P>La liste est vide";
?>
			<div class="ajouter" title="Ajouter une personne"><a class="a" href='ajout_form_even.php?eid=<?php echo $row['eid'] ?>'>Ajouter</a></div>
<?php
    	}else{
		?>
			Cette personne à bien été inscrite
		<a href='../eve/liste_even.php'>Revenir à la liste des événements</a>
<?php
    $db=null;
     }
	} else {
	?>
	Cette personne est déjà inscrite à cet événement
		<a href='../eve/liste_even.php'>Revenir à la liste des événements</a>
	<?php 
	}	
        }catch(PDOException $e){
        echo "Erreur SQL:".$e->getMessage();
        }
}
include("../footer.php"); 
?>

