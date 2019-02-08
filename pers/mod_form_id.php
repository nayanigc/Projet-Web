<?php
require("../auth/EtreAuthentifie.php");
include("../header.php");
if(!isset($_GET['tid']) && !isset($_GET['pid'])){

    echo "Erreur: pid non défini";
    echo "TID : " . $_GET['tid'];
}else {
    require("../db_config.php");
    $tid=$_GET['tid'];
	$pid=$_GET['pid'];
    try{
        $db = new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username,$password);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL = "SELECT valeur FROM identifications WHERE tid=? && pid = ?";
        $st= $db->prepare($SQL);
        $res = $st->execute(array($tid,$pid));
        if($row=$st->fetch()){
			echo'<div class="titre" style="width:20%;position:relative;right:-40%;margin-top:10%;">';
            echo ' ';
            echo ' ';
        }
    }catch(PDOException $e){
        echo "Erreur SQL:".$e->getMessage();
    }
}
?>

<div class="titre" style="
	width: 21%;
    position: relative;
    right: -40%;
    bottom: -25%;
	margin-top: 15%; ">
	<h4><b>Modifie le nom du type</b></h4>
    <form action="mod_id.php?pid=<?php echo $_GET['pid'] ?>&tid=<?php echo $_GET['tid'] ?>" method="post">

		<label for="inputValeur" class="control-label">Valeur</label>
		<input type="text" name="valeur" class="form-control" id="inputValeur" placeholder="valeur" required value="<?=$row['valeur'] ??""?>">
        <div class="form-group">
        <button type="submit" class="btn btn-primary"> Valider</button>
		<a class="btn btn-primary"  href= "liste_pers.php">Annule </a> 

                      
		</div>
	</form>
</div>
   <?php
    include("../footer.php");
                  ?>