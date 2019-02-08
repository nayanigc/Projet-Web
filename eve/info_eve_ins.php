<?php 

$page_title ="Information pour chaque evemenent";
include("../header.php");
include("navbar2.php");
include("info_even.php");
require("../db_config.php");

$eid = $_GET['eid'];    
try {
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$SQL="SELECT nom, prenom, date FROM participations INNER JOIN personnes ON participations.pid = personnes.pid INNER JOIN evenements ON participations.eid = evenements.eid WHERE participations.eid=?";
        $st = $db->prepare($SQL);
        $res = $st->execute(array($eid));
	
$SQL1="SELECT * FROM identifications INNER JOIN itypes ON identifications.tid = itypes.tid";
	   $st1 = $db->query($SQL1);
if ($st->rowCount()==0 || $st1->rowCount ()==0 ){
    echo "<P>La liste est vide"; 
}else {
    ?>  
     <style> table { border-collapse: collapse }
       </style>
	<table class="table table-striped">
	<thead>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Identification</th>	

	</thead>
<?php
while($row=$st->fetch()) {
?>

      <tr>
          <td><?php echo htmlspecialchars($row['nom'])?></td>
    <td><?php echo htmlspecialchars($row['prenom'])?></td>
		  <td><?php echo htmlspecialchars($row['date'])?></td>
    </tr>
<?php
 }; 
echo "</table>";
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
?>
<div class="container">
          <h2> <center>Liste des inscrits n'ayant pas participé</center></h2>
        </div>
<?php
		$eid = $_GET['eid']; 
try {
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$SQL3="SELECT nom, prenom ,personnes.pid as pid FROM personnes
    INNER JOIN inscriptions ON personnes.pid = inscriptions.pid
    WHERE inscriptions.pid != ALL (SELECT participations.pid FROM participations WHERE participations.eid=$eid) and inscriptions.eid=$eid";;
        $st3 = $db->prepare($SQL3);
        $res = $st3->execute(array($eid,$eid));
if ($st3->rowCount()==0){
    echo "<P>La liste est vide"; 
}else {
    ?>  
		


     <style> table { border-collapse: collapse }
       </style>
	<table class="table table-striped">
	<thead>
		<th>Nom</th>
		<th>Prénom</th>

	</thead>
<?php
while($row=$st3->fetch()) {
?>

      <tr>
          <td><?php echo htmlspecialchars($row['nom'])?></td>
		  <td><?php echo htmlspecialchars($row['prenom'])?></td>
		   <td><a href='../pointage/sup_pointage.php?pid=<?php echo $row['pid'] ?>'>Supprimer</a></td>
      </tr

<?php
 };
echo "</table>\n"; 
	?>
	<?php
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}

include("../footer.php");
?>

	
	
	
	