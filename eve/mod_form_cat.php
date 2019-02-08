<?php

require("../auth/EtreAuthentifie.php");
include("../header.php");
if(!isset($_GET['cid'])){
    echo "Erreur: cid non défini";
    echo "CID : " . $_GET['cid'];
}else {
    require("../db_config.php");
    $cid=$_GET['cid'];
    try{
        $db = new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username,$password);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL = "SELECT nom FROM categories WHERE cid=?";
        $st= $db->prepare($SQL);
        $res = $st->execute(array($cid));
        if($row=$st->fetch()){
        }
    }catch(PDOException $e){
        echo "Erreur SQL:".$e->getMessage();
    }
}
?>

<div class="titre" >
	<h4><b>Modifie le nom de la categorie</b></h4> 
            <form action="mod_cat.php?cid=<?php echo $_GET['cid'] ?>" method="post">

<label for="inputNom" class="control-label">Nom</label>
<input type="text" name="nom" class="form-control" id="inputNom" placeholder="nom" required value="<?= $row['nom']??""?>">
 <div class="form-group">
 <button type="submit" class="btn btn-primary" style="margin-top:4%;"> Valider</button>
				</div>
	 </form>
                    </div>
   <?php
    include("../footer.php");
                  ?>