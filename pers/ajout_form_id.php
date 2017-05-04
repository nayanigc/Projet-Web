<?php 
session_start();
include("../header.php");

if(!isset($_GET['pid']) ){
    include("info_pers.php");
} else {
    $pid = $_GET['pid'];
    require("../db_config.php");
    try{
        $db=new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL="SELECT * FROM itypes";
        $res = $db->query($SQL);
        $db=null;
     }catch (PDOException $e){
         echo "Erreur SQL: ".$e->getMessage();
    } 
}
?>

<div class="titre" style="
	width: 21%;
    position: relative;
    right: -40%;
    bottom: -25%;
						  "> 
	<h4><b>Ajouter un autre moyen identification </b></h4>
<form class="form-group" action="ajout_id.php?pid=<?php echo $pid ?>" method="post"> 

<label for="inputNomType" class="control-label">identification</label>
        <select class="form-control" name="tid">
             <?php
                 while($row=$res->fetch()){
                    echo "<option value=".$row['tid'].">".$row['nom']."</option><br/>";
                 }
             ?>
        </select> 
 <label for="inputValeur" class="control-label">Valeur</label>
 <input type="text" name="valeur" class="form-control" id="inputValeur" placeholder="valeur" required value="<?= $data['valeur']??""?>">
 <button type="submit" style="margin-top: 4%;" class="btn btn-primary">Valider</button>
</form>
</div>

<?php
include("../footer.php");
?>