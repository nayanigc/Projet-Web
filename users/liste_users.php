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
$SQL="SELECT * FROM users WHERE role='user'";
$res =$db->query($SQL);
if ($res->rowCount()==0)
    echo "<P>La liste est vide";
else {
    ?>    
<table>
     <style> table { border-collapse: collapse }
        td,th  {border: 1px solid black} </style>
<?php
while($row=$res->fetch()) {
?>

      <tr>
          <td><?php echo htmlspecialchars($row['login'])?></td>
          <td><?php echo $row['mdp']?></td>
           <td><a href='users/mod_form_user.php?uid=<?php echo $row['uid'] ?>'>Modifier</a></td>
          <td>  </td>
        
    </tr>

<?php
 };  
echo "</table>\n";
    ?>
    <div class="titre">Ajouter un Utilisateur</div>
            <form action="ajout_users.php" method="post">
                <table>
                    <tr>
                        <td><label for="inputLogin" class="control-label">Login</label></td>
                            <td><input type="text" name="login" class="form-control" id="inputLogin" placeholder="login" required value="<?= $data['login']??""?>"></td>
                    </tr>
                    <tr>
                        <td><label for="inputMDP" class="control-label">MDP</label></td>
                            <td><input type="password" name="mdp" class="form-control" id="inputMDP" placeholder="Mot de passe" required value=""></td>
                    </tr>
                    <tr>
                        <td><label for="inputMDP2" class="control-label">Répéter MDP</label></td>
                            <td><input type="password" name="mdp2" class="form-control" id="inputMDP" placeholder="Répéter le mot de passe" required value=""></td>
                    </tr>
                </table>
        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
           
<?php
echo "</form>";
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
include("footer.php");
?>
