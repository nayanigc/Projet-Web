<?php

include("../header.php");
require("../db_config.php");
include("navbar.php");
//echo "Avec un formulaire, envoyer le eid et le pid depuis la page de pers_pointage pour l'inserer dans la table participation";

$eid = $_GET['eid'];  
$uid= $_SESSION['uid'];
try {
	$type="";
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$SQL="SELECT nom, prenom, personnes.pid as ppid ,evenements.type as type, evenements.intitule as intitule FROM inscriptions INNER JOIN users ON inscriptions.uid=users.uid INNER JOIN personnes ON inscriptions.pid = personnes.pid INNER JOIN evenements ON inscriptions.eid = evenements.eid INNER JOIN identifications ON identifications.pid=inscriptions.pid WHERE inscriptions.eid=?";
$st = $db->prepare($SQL);
$res = $st->execute(array($eid));
	
if ($st->rowCount()==0){
    echo "<P>La liste est vide"; 
}else {
	$row = $st->fetch();
	$event_name = $row['intitule'];
	
    ?> 
	<h2  class="titre" style="margin-left: 40%;"><?php echo $row['intitule'] ?></h2>
	<br />
     <style> table { border-collapse: collapse }
        td,th  {border: 1px solid black} </style>
	<table class="table table-striped">
	<thead>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Identifications</th>
		<th>Pointage</th>
		<th>Soumission batch</th>
	</thead>
		<tr>
   <td><?php echo htmlspecialchars($row['nom'])?></td>
   <td><?php echo htmlspecialchars($row['prenom'])?></td>
	 <td><select>
		 <?php 
			$SQL1 = "SELECT identifications.pid as pidI, itypes.nom as nom, valeur, identifications.tid as Itid
			FROM identifications
			RIGHT JOIN personnes ON identifications.pid = personnes.pid
			LEFT JOIN itypes ON identifications.tid = itypes.tid WHERE identifications.pid=?";
						  
			$req = $db->prepare($SQL1);
    		$res = $req->execute(array($row['ppid']));
						  
			while ($row1=$req->fetch()) { 
				echo"<option value=".$row1['Itid'].">".$row1['nom']." ".$row1['valeur']."</option> </br>" ; 
			} 
		 ?>
		 </select>
	 </td>
	 <td>
		 <a href='pointage.php?pid=<?php echo "$row[ppid]";?>&amp;eid=<?php echo "$eid";?>&amp;uid=<?php echo "$uid";?>' class='btn btn-info'>Pointer</a>
	 </td>
	 <td>
	 	<form method="post" action='bash.php?pid=<?php echo "$row[ppid]";?>&amp;eid=<?php echo "$eid";?>&amp;uid=<?php echo "$uid";?>'>
		 	<input type="checkbox" name="checkbox[]" value="<?php echo $row['ppid']; ?>"/>
	 </td>
</tr>
<?php
while($row=$st->fetch()) {
$type=$row['type'];
?>
 <tr>
   <td><?php echo htmlspecialchars($row['nom'])?></td>
   <td><?php echo htmlspecialchars($row['prenom'])?></td>
	 <td><select>
		 <?php 
			$SQL1 = "SELECT identifications.pid as pidI, itypes.nom as nom, valeur, identifications.tid as Itid
			FROM identifications
			RIGHT JOIN personnes ON identifications.pid = personnes.pid
			LEFT JOIN itypes ON identifications.tid = itypes.tid WHERE identifications.pid=?";
						  
			$req = $db->prepare($SQL1);
    		$res = $req->execute(array($row['ppid']));
						  
			while ($row1=$req->fetch()) { 
				echo"<option value=".$row1['Itid'].">".$row1['nom']." ".$row1['valeur']."</option> </br>" ; 
			} 
		 ?>
		 </select>
	 </td>
	 <td>
		 <a href='pointage.php?pid=<?php echo "$row[ppid]";?>&amp;eid=<?php echo "$eid";?>&amp;uid=<?php echo "$uid";?>' class='btn btn-info'>Pointer</a>
	 </td>
	 <td>
	 	<form method="post" action='bash.php?pid=<?php echo "$row[ppid]";?>&amp;eid=<?php echo "$eid";?>&amp;uid=<?php echo "$uid";?>'>
		 	<input type="checkbox" name="checkbox[]" value="<?php echo $row['ppid']; ?>"/>
	 </td>
</tr>
<?php
 } 
?>
</table>

<input class="btn btn-primary" style="margin-left: 80%;" type="submit" value="Soumission batch" />
</form>

<?php
	if ($type=="ferme"){
		echo"<h3>vous ne pouvez pas ajouter de personnes<h3>";
	}else{
	try{
        $db=new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL="SELECT * FROM itypes";
        $res = $db->query($SQL);
        $db=null;
     }catch (PDOException $e){
         echo "Erreur SQL: ".$e->getMessage();
    }
	?>

<div class="row">
	<div class="col-lg-3">
	</div>
	<div class="col-lg-6">
		<form method="post" action="pointage_pers_ext.php?eid=<?php echo $eid ?>&uid=<?php echo $uid ?>">
			<h2>Ajouter une personne extérieur</h2>
					<div class="form-group">
					  <label for="inputNom" class="control-label">Nom</label>
					  <input type="text" name="nom" size="20" class="form-control" id="inputLogin" required placeholder="Nom"
												   required value="<?= $data['login']??"" ?>">
					</div>
					<div class="form-group">
					  <label for="inputMDP" class="control-label">Prénom</label>
					  <input type="text" name="prenom" size="20" class="form-control" required id="inputMDP"
												   placeholder="Prénom">
					</div>
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
					<div class="form-group">
					  <label for="inputValeur" class="control-label">Valeur</label>
					  <input type="text" name="valeur" size="20" class="form-control" required id="inputMDP"
												   placeholder="valeur">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Ajout</button>
					</div>
		
		</form>
	</div>
	<div class="col-lg-3">
	</div>
</div>

<?php
$db=null;
     };
	}
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
include("../footer.php");