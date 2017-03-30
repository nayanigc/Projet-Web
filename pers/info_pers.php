<?php 
$page_title ="Information personnel";
include("../header.php");
require("../db_config.php");
$pid = $_GET['pid'];    
try {
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$SQL="SELECT personnes.nom as nomPersonne, prenom, itypes.nom as nomType, valeur
        FROM identifications
        INNER JOIN personnes ON identifications.pid = personnes.pid
        INNER JOIN itypes ON identifications.tid = itypes.tid
        WHERE personnes.pid=?"
;
        $st = $db->prepare($SQL);
        $res = $st->execute(array($pid));
if ($st->rowCount()==0){
    echo "<P>La liste est vide"; 
    ?>
      <td><a href='ajout_form_id.php?pid=<?php echo $pid ?>'>Ajouter une Personne au complet </a></td>
    <?php
}else {
    ?>    
<table>
     <style> table { border-collapse: collapse }
        td,th  {border: 1px solid black} </style>
<?php
while($row=$st->fetch()) {
?>

      <tr>
          <td>Nom : <?php echo htmlspecialchars($row['nomPersonne'])?></td> 
          <td>Prenom : <?php echo htmlspecialchars($row['prenom'])?></td>
          <td>Nom  du type : <?php echo htmlspecialchars($row['nomType'])?></td> 
          <td>valeur : <?php echo htmlspecialchars($row['valeur'])?></td>
    </tr>

<?php
 };
echo "</table>\n";
    
  ?>
      <td><a href='ajout_form_id.php?pid=<?php echo $pid ?>'>Ajouter une Personne au complet </a></td>
    <?php
    
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
include("../footer.php");
?>
