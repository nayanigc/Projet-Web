<?php 
$page_title ="Liste personne";
include("../header.php");
include("navbar.php");
include("pers.php");
require("../db_config.php");
try {
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$SQL="SELECT * FROM personnes ORDER BY nom ";
$res =$db->query($SQL); 

   
if ($res->rowCount()==0){
    echo "<P>La liste est vide";
?>
<div class="ajouter" title="Ajouter une personne"><a class="a" href='ajout_form_pers.php'>Ajouter</a></div>

<?php
}else {
    ?> 
<style> 
	table { border-collapse: collapse }
 	td,th  {border: 1px solid black} 

	/*html{
		background-color: #d6cbe2;
	}*/
</style>
<table class="table table-striped">
	<thead>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Modifier</th>
		<th>Supprimer</th>
		<th>Consulter</th>
	</thead>
<?php
while($row=$res->fetch()) {
?>
 <form action ="info_pers.php?pid=<?php echo $row['pid'] ?>" method="post">
	    <tr>
          <td><?php echo htmlspecialchars($row['nom'])?></td> 
          <td><?php echo htmlspecialchars($row['prenom'])?></td>
          <td><a href='mod_form_pers.php?pid=<?php echo $row['pid'] ?>'>Modifier</a></td>
          <td><a href='sup_pers.php?pid=<?php echo $row['pid'] ?>'>Supprimer</a></td>

          <input type="hidden" name="nom" value="<?php echo htmlspecialchars($row['nom'])?>"/>
          <input type="hidden" name="prenom" value="<?php echo htmlspecialchars($row['prenom'])?>"/>
          
          <td><input type=submit class="envoyer" value="Gerer les informations personnelles"/> 
          </td>
        </tr>
</form>

<?php
 };  
echo "</table>\n";
    ?>
 </table>
<div class="ajouter" title="Ajouter une personne"><a class="a" href='ajout_form_pers.php'>Ajouter</a></div>

	  
    <?php
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
include("../footer.php");
?>
    
