<?php
$page_title="Liste evenement";
include("../header.php");
//include("");
require("../db_config.php");
if (!isset($_GET['uid']) && !isset ($_GET['pid'])&& ($_GET['eid'])){
 echo " erreur";
	
}else {
	$uid=$_GET['uid'];
	$pid=$_GET['pid'];
	$eid=$_GET['eid'];
	
try{
    $db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$SQL = "SELECT* FROM identifications INNER JOIN personnes ON identifications.pid = personnes.pid WHERE personnes.pid = ?";
		 $st=$db->query($SQL);

	if($st->rowCount()==0){
$SQL="INSERT INTO inscriptions VALUES (?,?,?)";
    $st1=$db->prepare($SQL);
	$res=$st1->execut(array($pid,$eid,$uid));
      if($res->rowCount()==0){
        echo"<P>La liste est vide";
?>
<div class="ajouter" title="Ajouter un evenement"><a class="a" href='ajout_form_even.php?eid=<?php echo $row['eid'] ?>'>Ajouter</a></div>
<?php
    }else{
?>
    <table>
        <style> table {border-collapse:collapse}
        td,th {border: 1px solid black} </style>
		<table class="table table-striped">
	<thead>
		<th>Titre</th>
		<th>Description</th>
		<th>Date de debut</th>
		<th>Date de Fin</th>
		<th>Type</th>
		<th>Modifier</th>
		<th>Supprimer</th>
		<th>Consulter</th>
	</thead>
		
<?php
    while($row=$res->fetch()){
?>
    <tr>
	<td><?php echo htmlspecialchars($row['intitule']) ?> </td>
    <td><?php echo htmlspecialchars($row['description']) ?></td>
        <td><?php echo htmlspecialchars($row['dateDebut']) ?></td>
        <td><?php echo htmlspecialchars($row['dateFin']) ?></td>
        <td><?php echo htmlspecialchars($row['type']) ?></td>
       
        <td><a href='mod_form_eve.php?eid=<?php echo $row['eid'] ?>'>Modifie un evenement</a></td>
           <td><a href='sup_eve.php?eid=<?php echo $row['eid'] ?>'>Supprimer</a></td>
           <td><a href='info_eve.php?eid=<?php echo $row['eid'] ?>'>Information sur l'evenement</a></td>
     

          </tr>
<?php      
    };
    echo "</table>\n";
    ?>
		</table>
<div class="ajouter" title="Ajouter un evenement"><a class="a" href='ajout_form_even.php?eid=<?php echo $row['eid'] ?>'>Ajouter</a></div>
<?php
    $db=null;
     };
	}
        }catch(PDOException $e){
        echo "Erreur SQL:".$e->getMessage();
        }
}
include("../footer.php"); 
?>

