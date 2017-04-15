<?php 
$page_title ="Liste  utilisateur";
include("../header.php");
include("user.php");
// mettre un fond vert pour les admis et un fond bleu pour les utilisateur 
//echo $idm->getIdentity();
require("../db_config.php");
//mettre un message quand le login est deja pris
try {
$db= new PDO("mysql:hostname=$hostname;dbname=$dbname",$username);
$db->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$SQL="SELECT * FROM users WHERE role='user'";
$res =$db->query($SQL);
if ($res->rowCount()==0){
    echo "<P>La liste est vide";
	?>
<td><a href='ajout_form_user.php?uid=<?php echo $row['uid'] ?>'>Ajouter une Utilisateur en plus </a></td>
        <?php
}else {
    ?>    
<table>
     <style> table { border-collapse: collapse }
        td,th  {border: 1px solid black} </style>
	<table class="table table-striped">
	<thead>
		<th>Login</th>
		<th>Modifier</th>
	</thead>
<?php
while($row=$res->fetch()) {
?>

      <tr>
          <td><?php echo htmlspecialchars($row['login'])?></td>
          <td><a href='mod_form_user.php?uid=<?php echo $row['uid'] ?>'>Modifier le mot de passe</a></td>
        
    </tr>

<?php
 };  
echo "</table>\n";
    ?>
	</table>
    <td><a href='ajout_form_user.php?uid=<?php echo $row['uid'] ?>'>Ajouter une Utilisateur en plus </a></td>
        <?php
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
include("../footer.php");
?>
