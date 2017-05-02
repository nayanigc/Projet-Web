<?php
include("header.php");

echo $_SESSION['uid'];

require("db_config.php");
try{
    $db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $SQL="SELECT * FROM evenements INNER  JOIN categories ON evenements.cid = categories.cid";
    $res=$db->query($SQL);
    if($res->rowCount()==0){
        echo"<P>La liste est vide";
    }else{
		?>
<style> 
	table {
		border-collapse:collapse
		position: relative;			
	}
    td,th {
			border: 1px solid black
	} 
</style>
<table class="table table-striped" style="margin-top: 10%;">
	<thead>
		<th>Titre</th>
		<th style="widht:27% !important;">Description</th>
		<th>Date de debut</th>
		<th>Date de Fin</th>
		<th>Type</th>
		<th>Information</th>
		
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
		 <td><a href='pointage/pers_pointage.php?eid=<?php echo $row['eid'] ?>'>Information sur l'evenement</a></td>
     
	
	</tr>
<?php
	}
	$db=null;
	}
	}catch(PDOException $e){
		echo "Erreur SQL: ".$e->getMessage();
	}
include("footer.php"); 
?>