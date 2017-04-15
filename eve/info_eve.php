<?php 

$page_title ="Information pour chaque evemenent";
include("../header.php");
include("info_even.php");
require("../db_config.php");

$eid = $_GET['eid'];    
try {
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$SQL="SELECT nom, prenom  FROM participations INNER JOIN users ON participations.uid=users.uid INNER JOIN personnes ON participations.pid = personnes.pid INNER JOIN evenements ON participations.eid = evenements.eid WHERE participations.eid=?"
;
        $st = $db->prepare($SQL);
        $res = $st->execute(array($eid));
if ($st->rowCount()==0){
    echo "<P>La liste est vide"; 
}else {
    ?>  

<table>
     <style> table { border-collapse: collapse }
        td,th  {border: 1px solid black} </style>
	<table class="table table-striped">
	<thead>
		<th>Nom</th>
		<th>Prénom</th>	
		

	</thead>
<?php
while($row=$st->fetch()) {
?>

      <tr>
          <td><?php echo htmlspecialchars($row['nom'])?></td>
    <td><?php echo htmlspecialchars($row['prenom'])?></td>
    </tr>

<?php
 };
echo "</table>\n"; 
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
include("../footer.php");
?>

	
	
	
	