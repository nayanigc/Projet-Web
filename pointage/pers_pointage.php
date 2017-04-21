<?php
include("../header.php");
require("../db_config.php");

$eid = $_GET['eid'];  
$uid= $_GET['uid'];
$date= date("d-m-Y H:i:s");
$pid= $_POST['pid'];
try {
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	/*modifie pour faire en requete inscription*/
$SQL="SELECT nom, prenom FROM participations INNER JOIN users ON participations.uid=users.uid INNER JOIN personnes ON participations.pid = personnes.pid INNER JOIN evenements ON participations.eid = evenements.eid WHERE participations.eid=?";
$st = $db->prepare($SQL);
$res = $st->execute(array($eid));

$SQL1="SELECT * FROM itypes";
$req = $db->prepare($SQL1);
$get = $req->execute();

$SQL2="INSERT INTO participation VALUES (DEFAULT,?,?,?,?)";
	$st2 = $db->prepare($SQL2);
$res = $st2->execute(array($eid,$pid,$date,$uid));
	
if ($st->rowCount()==0){
    echo "<P>La liste est vide"; 
}else {
    ?>  
     <style> table { border-collapse: collapse }
        td,th  {border: 1px solid black} </style>
	<table class="table table-striped">
	<thead>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Identifications</th>
	</thead>
<?php
while($row=$st->fetch()) {
?>

 <tr>
   <td><?php echo htmlspecialchars($row['nom'])?></td>
   <td><?php echo htmlspecialchars($row['prenom'])?></td>
	 <td><select><?php while ($row1=$req->fetch()) { echo"<option value=".$row1['tid'].">".$row1['nom']."</option> </br>"; } ?></select></td>
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