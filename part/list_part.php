<?php
$page_title ="Liste d'evenement";
include("../header.php");
include("part.php");
require("../db_config.php");
try{
    
    $db = new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $SQL="SELECT * FROM participations INNER JOIN users on participations.uid=users.uid INNER JOIN personnes ON participations.pid = personnes.pid INNER JOIN evenements  on participations.eid = evenements.eid";
    $res =$db->query($SQL);
        if ($res->rowCount()==0){
        echo"<p>La liste est vide";
    }else{
    ?>
<table>
    <style>table {border-collapse: collapse}
        td,th {border: 1px solid black}
    </style>
		
	<table class="table table-striped">
	<thead>
		<th>Nom</th>
		<th>Prénom</th>
		<th>users</th>
		<th>Evenement</th>
		<th>Description</th>
		<th>Date de Debut</th>
		<th>Date de Fin</th>
		<th>Type</th>
		<th>Date</th>
		</thead>
	
<?php
 while($row=$res->fetch()){
     ?>
    <tr>
    <td> <?php echo htmlspecialchars($row['nom'])?></td>
    <td><?php echo htmlspecialchars($row['prenom'])?></td>
    <td><?php echo htmlspecialchars($row['login'])?></td>
	<td> <?php echo htmlspecialchars($row['intitule'])?></td>
	<td> <?php echo htmlspecialchars($row['description'])?></td>
	<td><?php echo htmlspecialchars($row['dateDebut'])?></td>
	<td><?php echo htmlspecialchars($row['dateFin'])?></td>
	<td><?php echo htmlspecialchars($row['type'])?></td>
	<td><?php echo htmlspecialchars($row['date'])?></td>
	</tr>
                       
<?php
        };
echo "</table>\n";			
      $db = null;
 };
}catch (PDOException $e){
    echo"Erreur SQL:".$e->getMessage();
}
include("../footer.php");
?>