<?php 
$page_title ="Liste  personne";
include("../header.php");
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
   <td><a href='ajout_form_cat.php?cid=<?php echo $row['cid'] ?>'>Ajouter une categorie </a></td>

<?php
}else {
    ?>    
<table>
     <style> table { border-collapse: collapse }
        td,th  {border: 1px solid black} </style>	
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
         <td><a href='ajout_form_cat.php?cid=<?php echo $row['cid'] ?>'>Ajouter une categories</a></td>
     
    <?php
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
include("../footer.php");
?>
