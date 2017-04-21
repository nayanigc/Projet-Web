<?php 
if(!isset($_GET['eid']) ){
    include("liste_even.php");
} else {
    $eid = $_GET['eid'];
    require("../db_config.php");
    try{
        $db=new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL="SELECT * FROM categories";
        $req = $db->query($SQL);
        $db=null;
     }catch (PDOException $e){
         echo "Erreur SQL: ".$e->getMessage();
    } 
    
}
   require("../db_config.php");
    try{
        $db = new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username,$password);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL = "SELECT intitule,description,dateDebut,dateFin,evenements.cid,type FROM evenements INNER JOIN categories ON evenements.cid = categories.cid WHERE eid=?";
        $st= $db->prepare($SQL);
        $res = $st->execute(array($eid));
        while($row=$st->fetch()){
            echo 'Intitule: '.$row['intitule'].'</br>';
            echo 'Description: '.$row['description'].'</br>';
            echo 'DateDebut: '.$row['dateDebut'].'</br>';
            echo 'DateFin: '.$row['dateFin'].'</br>';
            echo 'Categorie: '.$row['cid'].'</br>';
            echo 'type: '.$row['type'].'</br>';
        }
    }catch(PDOException $e){
        echo "Erreur SQL:".$e->getMessage();
    }
?>
<link rel="stylesheet" href="style.css">
<div class="titre-eve"> <h4><b>Modifier un evenement</b></h4>
      <form action="mod_eve.php?eid=<?php echo $eid ?>" method="post">
		 <div id="inlineClass">
		  <div class="cat-inline"><label for="inputNomType" class="control-label">Categories</label>
               <div id="form-select"><select class="form-control"  name="cid">
                   <?php
                        while($row=$req->fetch()){
                        echo "<option value=".$row['cid'].">".$row['nom']."</option><br/>";
                                        }
                    ?>
                </select></div>
			  </div>
		  <div class="intitu"><label for="inputIntitule" class="control-label">Intitule</label>
    	  <input type="text" name="intitule" class="form-control form-input" id="inputIntitule" placeholder="intitule..." required value="<?= $data['intitule']??""?>"></div>
		 </div>
                        
     	  <div><label for="inputDescription" class="control-label">Description</label>
		  <textarea rows="5" type="text" name="description" class="form-control" id="inputDescription" placeholder="description..." required value="<?= $data['description']??""?>"></textarea></div>
  <div class="inline-element-root">
                        
    <p class="inline-element"><label for="inputDatedebut" class="control-label">Date de debut </label>
    <input type="date" name="datedebut" class="form-control" id="inputDatedebut" placeholder="datedebut" required value="<?= $data['datedebut']??""?>"></p>
    <p class="inline-element1"><label for="inputDateFin" class="control-label">Date de fin</label>
    <input type="date" name="datefin" class="form-control" id="inputDateFin" placeholder="datefin" required value="<?= $data['datefin']??""?>"></p>
     <p class="inline-element2"><label for="inputNomType" class="control-label">Type</label>
     <select class="form-control" name="type">
		<option>Ouvert</option>
        <option>Ferme</option>
     </select></p>
	</div>
     <button type="submit" class="btn btn-primary">Valider</button>
  </form>
</div>
   <?php
    include("../footer.php");
        ?>