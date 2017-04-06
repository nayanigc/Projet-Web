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
$SQL="SELECT * FROM evenements";
$res =$db->query($SQL); 
   
if ($res->rowCount()==0){
    echo "<P>La liste est vide";
?>
<?php
}else {
    ?>    
<table>
     <style> table { border-collapse: collapse }
        td,th  {border: 1px solid black} </style>
<?php
while($row=$res->fetch() ) {
?>

          <td>Titre : <?php echo htmlspecialchars($row['nom'])?></td>
      <tr>
          <td>Description : <?php echo htmlspecialchars($row['nom'])?></td>
        
    </tr>

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
include("footer.php");
?>
