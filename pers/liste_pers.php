<?php 
$page_title ="Liste  personne";
include("header.php");
//include("mise_en_page.php");
// mettre un fond vert pour les admis et un fond bleu pour les utilisateur //
//echo $idm->getIdentity();

require("db_config.php");
try {
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$SQL="SELECT * FROM personnes";
$res =$db->query($SQL); 

   
if ($res->rowCount()==0){
    echo "<P>La liste est vide";
?>
<td><a href='pers/ajout_form_pers.php?pid=<?php echo $row['pid'] ?>'>Modifier</a></td>

<?php
}else {
    ?>    
<table>
     <style> table { border-collapse: collapse }
        td,th  {border: 1px solid black} </style>
<?php
while($row=$res->fetch() ) {
?>

      <tr>
          <td>Nom : <?php echo htmlspecialchars($row['nom'])?></td> 
          <td>Prenom : <?php echo htmlspecialchars($row['prenom'])?></td>
          <td><a href='pers/mod_form_pers.php?pid=<?php echo $row['pid'] ?>'>Modifier</a></td>
          <td><a href='pers/sup_pers.php?pid=<?php echo $row['pid'] ?>'>Supprimer</a></td>

          <td><a href='pers/info_pers.php?pid=<?php echo $row['pid'] ?>'>Gerer les informations personnelles</a> 
          </td>
        
    </tr>

<?php
 };  
echo "</table>\n";
    ?>
      <td><a href='pers/ajout_form_pers.php?pid=<?php echo $row['pid'] ?>'>Ajouter une Personne </a></td>
    <?php
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
include("footer.php");
?>
