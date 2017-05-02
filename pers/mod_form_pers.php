<?php
session_start();
include("../header.php");
if(!isset($_GET['pid'])){
    echo "Erreur: pid non défini";
    echo "PID : " . $_GET['pid'];
}else {
    require("../db_config.php");
    $pid=$_GET['pid'];
    try{
        $db = new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username,$password);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL = "SELECT nom,prenom FROM personnes WHERE pid=?";
        $st= $db->prepare($SQL);
        $res = $st->execute(array($pid));
        if($row=$st->fetch()){
			echo'<div class="titre" style="width:20%;position:relative;right:-40%;margin-top:10%;">';
            echo '<p><label>Nom: '.$row['nom'].' </label>';
            echo '<label> Prénom: '.$row['prenom'].'</label></p>';
        }
    }catch(PDOException $e){
        echo "Erreur SQL:".$e->getMessage();
    }
}
?>
<style>
	label{
		margin-left: 5%;
	}
</style>
	<h4><b>Modifie le mot  de passe</b></h4>
	<form class="form-group" action="mod_pers.php?pid=<?php echo $_GET['pid'] ?>" method="post">
		<label for="inputNom" class="control-label">Nom</label>
		<input type="text" name="nom" class="form-control" id="inputNom" placeholder="nom" required value="<?= $data['nom']??""?>">
		<label for="inputPrenom" class="control-label">Prénom</label>
		<input type="text" name="prenom" class="form-control" id="inputPrenom" placeholder="prenom" required value="<?= $data['prenom']??""?>">
        <button type="submit" class="btn btn-primary" style="margin-top:4%;"> Valider</button>
	</form>
   <?php
    include("../footer.php");
                  ?>