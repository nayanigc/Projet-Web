<?php 
$page_title ="Liste  utilisateur";
include("header.php");
//include("mise_en_page.php");
// mettre un fond vert pour les admis et un fond bleu pour les utilisateur 
//echo $idm->getIdentity();
require("db_config.php");
try {
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$SQL="SELECT personnes.nom as nomPersonne, prenom, itypes.nom as nomType, valeur 
        FROM identifications
        INNER JOIN personnes ON identifications.pid = personnes.pid
        INNER JOIN itypes ON identifications.tid = itypes.tid"
;
$res =$db->query($SQL);
if ($res->rowCount()==0){
    echo "<P>La liste est vide";
// ajoute un formulaire et appel le formulaire a interieur 
?>

<?php
}else {
    ?>    
<table>
     <style> table { border-collapse: collapse }
        td,th  {border: 1px solid black} </style>
<?php
while($row=$res->fetch()) {
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
      <td><a href='id/ajout_form_id.php?pid=<?php echo $row['pid'] ?>'>Ajouter une Personne  au complet </a></td>
    <?php
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
include("footer.php");
?>
