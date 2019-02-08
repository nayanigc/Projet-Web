<?php

require("../auth/EtreAuthentifie.php");

include("../header.php");
if(!isset($_GET['tid'])){
    echo "Erreur: tid non défini";
    echo "TID : " . $_GET['tid'];
}else {
	 try{ 
    $tid = $_GET['tid'];
    require("../db_config.php");
    $db = new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $SQL ="SELECT nom FROM itypes WHERE tid =:tid";
        $st=$db->prepare($SQL);
        $tid= $_GET['tid'];
    $st->execute(['tid'=>$tid]);
    if ($row=$st->fetch()){
	}
	   $db=null;
    }catch(PDOException $e){
    echo "Erreur SQL: ".$e->getMessage();
    }
}
?>

<div class="titre" style ="   width: 21%;
    position: relative;
    right: -40%;
    bottom: -25%;
	margin-top: 15%; "> 
	<h4><b>Modifie le nom du type </b></h4>
     <form action="mod_type.php?tid=<?php echo $_GET['tid'] ?>" method="post">
<label for="inputNom" class="control-label">Nom</label>
 <input type="text" name="nom" class="form-control" id="inputNom" placeholder="nom" required value="<?= $row['nom']??""?>">
 <div class="form-group">
 <button type="submit" class="btn btn-primary"style =" margin-top: 4%;"> Valider</button>
                      
                    </div>
</form>
</div>
   <?php
    include("../footer.php");
                  ?>