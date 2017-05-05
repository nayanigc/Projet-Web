<?php 
$page_title ="Liste  personne";
include("../header.php");
include("navbar2.php");
include("cat.php");

require("../db_config.php");
try {
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$SQL="SELECT * FROM categories";
$res =$db->query($SQL); 

   
if ($res->rowCount()==0){
    echo "<P>La liste est vide";
?>
<div class="ajouter" title="Ajouter une personne"><a class="a" href='ajout_form_cat.php'>Ajouter une categorie</a></div>

<?php
}else {
    ?>    
<table>
     <style> table { border-collapse: collapse }
        </style>	
	<table class="table table-striped">
	<thead>
		<th>Nom</th>
		<th>Modifier</th>	
		<th>Supprimer</th>

	</thead>
<?php
while($row=$res->fetch() ) {
?>

      <tr>
          <td><?php echo htmlspecialchars($row['nom'])?></td> 
          <td><a href='mod_form_cat.php?cid=<?php echo $row['cid'] ?>'>Modifier</a></td>
           <td><a href='sup_cat.php?cid=<?php echo $row['cid'] ?>'>Supprimer</a></td>
    </tr>

<?php
 };  
echo "</table>\n";
    ?>
      <div class="ajouter" title="Ajouter une personne"><a class="a" href='ajout_form_cat.php'>Ajouter une categorie</a></div>
     
    <?php
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
include("../footer.php");
?>
