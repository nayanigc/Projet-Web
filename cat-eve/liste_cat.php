<?php 
$page_title ="Liste  personne";
include("header.php");


require("db_config.php");
try {
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$SQL="SELECT * FROM categories";
$res =$db->query($SQL); 

   
if ($res->rowCount()==0){
    echo "<P>La liste est vide";
?>
   <td><a href='cat-eve/ajout_form_cat.php?cid=<?php echo $row['cid'] ?>'>Ajouter une categorie </a></td>

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
          <td><a href='cat-eve/mod_form_cat.php?cid=<?php echo $row['cid'] ?>'>Modifier</a></td>
           <td><a href='cat-eve/sup_cat.php?cid=<?php echo $row['cid'] ?>'>Supprimer</a></td>
    </tr>

<?php
 };  
echo "</table>\n";
    ?>
         <td><a href='cat-eve/ajout_form_cat.php?cid=<?php echo $row['cid'] ?>'>Ajouter une categories</a></td>
     
    <?php
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
include("footer.php");
?>
