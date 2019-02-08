<?php 

	require("../auth/EtreAuthentifie.php");

    require("../db_config.php");
    try{
        $db=new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL="SELECT * FROM personnes ORDER BY nom";
        $res = $db->query($SQL);
        $db=null;
     }catch (PDOException $e){
         echo "Erreur SQL: ".$e->getMessage();
    } 


?>
<div class="titre"  style ="width: 21%;
    position: relative;
    right: -40%;
    bottom: -25%; ">
	<h4><b>Ajoute</b></h4> 
            <form action="ajout_ins.php?eid=<?php echo $_GET['eid'] ?>" method="post">
<label for="inputNomPersonne" class="control-label"> La personne </label>
        <select class="form-control" name="pid">
             <?php
                 while($row=$res->fetch()){
                    echo "<option value=".$row['pid'].">".$row['nom']." ".$row['prenom']."</option><br/>";
                 }
             ?>
        </select> 
	<button type="submit" class="btn btn-primary">Valider</button>
	</form>
</div>
				<?php 
				include("../footer.php");