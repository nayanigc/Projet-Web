<?php 
 $pid = $_GET['pid'];
    require("../db_config.php");
    try{
        $db=new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL="SELECT * FROM personnes";
        $res = $db->query($SQL);
        $db=null;
     }catch (PDOException $e){
         echo "Erreur SQL: ".$e->getMessage();
    } 


?>
<div class="titre">Ajoute </div>
            <form action="ajout_ins.php?pid=<?php echo $_GET['pid'] ?>&eid=<?php echo $_GET['eid'] ?>&uid=<?php echo $_GET['uid'] ?>" method="post">
<label for="inputNomType" class="control-label"> La personne </label>
        <select class="form-control" name="tid">
             <?php
                 while($row=$res->fetch()){
                    echo "<option value=".$row['pid'].">".$row['nom']." ".$row['prenom']."</option><br/>";
                 }
             ?>
        </select> 
	<button type="submit" class="btn btn-primary">Valider</button>
				<?php 
				include("../footer.php");