<?php 
if(!isset($_GET['pid']) ){
    include("info_pers.php");
} else {
    $pid = $_GET['pid'];
    require("../db_config.php");
    try{
        $db=new PDO("mysql:hostname=$hostname;dbname=$dbname",$username);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL="SELECT * FROM itypes";
        $res = $db->query($SQL);
        $db=null;
     }catch (PDOException $e){
         echo "Erreur SQL: ".$e->getMessage();
    } 
}
?>

<div class="titre"> <h4>Ajouter un autre moyen identification </h4></div>
<!--<form class="form-horizontal" action="ajout_id.php?pid=<?php echo $pid ?>" method="post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="iden">identification :</label>
    <div class="col-sm-10">
      <select class="form-control" id="iden" name="tid">
             <?php
                 /*while($row=$res->fetch()){
                    echo "<option value=".$row['tid'].">".$row['nom']."</option><br/>";
                 }*/
             ?>
        </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Valeur :</label>
    <div class="col-sm-10"> 
      <input name="valeur" type="text" class="form-control" id="inputValeur" placeholder="Valeur..." required value="<?= $data['valeur']??""?>">
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>!-->




<form class="form-horizontal" action="ajout_id.php?pid=<?php echo $pid ?>" method="post"> 
	<div class="form-group">
       	<label for="inputNomType" class="control-label">identification</label>
        <select class="form-control" name="tid">
             <?php
                 while($row=$res->fetch()){
                    echo "<option value=".$row['tid'].">".$row['nom']."</option><br/>";
                 }
             ?>
        </select> 
	</div>
        <label for="inputValeur" class="control-label">Valeur</label>
        <input type="text" name="valeur" class="form-control" id="inputValeur" placeholder="valeur" required value="<?= $data['valeur']??""?>">
        <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php
include("../footer.php");
?>