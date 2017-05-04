<?php 

//include("navbar2.php");
$page_title ="Information personnel";
include("../header.php");
include("navbar3.php");
include("info_per.php");
require("../db_config.php");

$pid = $_GET['pid'];    
try {
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$SQL="SELECT personnes.nom as nomPersonne, prenom, itypes.nom as nomType, valeur,itypes.tid as tid
        FROM identifications
        INNER JOIN personnes ON identifications.pid = personnes.pid
        INNER JOIN itypes ON identifications.tid = itypes.tid
        WHERE personnes.pid=?"
;
        $st = $db->prepare($SQL);
        $res = $st->execute(array($pid));
if ($st->rowCount()==0){
    echo "La liste des identificatons est vide"; 
    ?>
		<br />
      <a href='ajout_form_id.php?pid=<?php echo $pid ?>'>Ajouter un type</a>
    <?php
}else {
    ?>  
  
<div class="titre"><h1><?php echo $_POST['nom']." ".$_POST['prenom'] ?></h1></div>

<div>
	<br />
	<div class="titre"><h2>Liste des identifications</h2></div>
     <style> table { border-collapse: collapse }
        td,th  {border: 1px solid black} </style>
	<table class="table table-striped">
	<thead>
		<th>Nom du type</th>
		<th>valeur</th>
		<th>Modifier</th>
		<th>Supprimer</th>
	</thead>
	
<?php
while($row=$st->fetch()) {
?>

      <tr>
          <td><?php echo htmlspecialchars($row['nomType'])?></td> 
          <td><?php echo htmlspecialchars($row['valeur'])?></td>
          <td><a href='mod_form_id.php?pid=<?php echo $pid ?>&tid=<?php echo $row['tid'] ?>'>Modification</a></td><td><a href='del_form_id.php?pid=<?php echo $pid ?>&tid=<?php echo $row['tid'] ?>'>Supprimer</a></td>
   
    </tr>

<?php
 };  
?>
	</table>
	<div class="ajouter"><a class="a" href='ajout_form_id.php?pid=<?php echo $pid ?>' title="Ajouter un type">Ajouter un type</a></div>
</div>
<?php
    
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
	
 //}else{
	 

try {
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$SQL="SELECT * FROM
       participations INNER JOIN users on participations.uid=users.uid INNER JOIN personnes ON participations.pid = personnes.pid INNER JOIN evenements  on participations.eid = evenements.eid
        WHERE personnes.pid=?"
;
        $st = $db->prepare($SQL);
        $res = $st->execute(array($pid));
if ($st->rowCount()==0){
    echo "<P>La liste est vide"; 
}else {
    ?>  
	<br />
	<div class="titre"><h2>Liste des participations</h2></div>
	
<table>
     <style> table { border-collapse: collapse }
        td,th  {border: 1px solid black} </style>
	<table class="table table-striped">
	<thead>
		<th>users</th>
		<th>Evenement</th>
		<th>Description</th>
		<th>Date de Debut</th>
		<th>Date de Fin</th>
		<th>Type</th>
		<th>Date</th>
	</thead>
<?php
while($row=$st->fetch()) {
?>

    <tr>
    <td><?php echo htmlspecialchars($row['login'])?></td>
	<td> <?php echo htmlspecialchars($row['intitule'])?></td>
	<td> <?php echo htmlspecialchars($row['description'])?></td>
	<td> <?php echo htmlspecialchars($row['dateDebut'])?></td>
	<td><?php echo htmlspecialchars($row['dateFin'])?></td>
	<td><?php echo htmlspecialchars($row['type'])?></td>
	<td><?php echo htmlspecialchars($row['date'])?></td>
	</tr>
<?php
 };
?>
</table>
<?php
    
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}



try {
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$SQL="	SELECT * FROM inscriptions INNER JOIN users on inscriptions.uid=users.uid INNER JOIN personnes ON inscriptions.pid = personnes.pid INNER JOIN evenements  on inscriptions.eid = evenements.eid
		WHERE personnes.pid=?
		AND NOT EXISTS (SELECT * FROM
       participations INNER JOIN users on participations.uid=users.uid INNER JOIN personnes ON participations.pid = personnes.pid INNER JOIN evenements  on participations.eid = evenements.eid
        WHERE personnes.pid=?)"
;
        $st = $db->prepare($SQL);
        $res = $st->execute(array($pid, $pid));
if ($st->rowCount()==0){
    echo "La liste inscriptions sans participation est vide"; 
}else {
    ?>  
	
	<div class="titre"><h2>Liste des inscription sans participation</h2></div>
<table>
     <style> table { border-collapse: collapse }
        td,th  {border: 1px solid black}
		html{
		background-color: #d6cbe2;
	}</style>
	<table class="table table-striped">
	<thead>
		<th>users</th>
		<th>Evenement</th>
		<th>Description</th>
		<th>Date de Debut</th>
		<th>Date de Fin</th>
		<th>Type</th>
		
	</thead>
<?php
while($row=$st->fetch()) {
?>

    <tr>
    <td><?php echo htmlspecialchars($row['login'])?></td>
	<td> <?php echo htmlspecialchars($row['intitule'])?></td>
	<td> <?php echo htmlspecialchars($row['description'])?></td>
	<td> <?php echo htmlspecialchars($row['dateDebut'])?></td>
	<td><?php echo htmlspecialchars($row['dateFin'])?></td>
	<td><?php echo htmlspecialchars($row['type'])?></td>
<?php
 };
?>
</table>
<?php
    
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}

//}
include("../footer.php");
?>

	
	
	
	