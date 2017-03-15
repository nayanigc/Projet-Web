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
$SQL="SELECT * FROM personnes";
$res =$db->query($SQL);
if ($res->rowCount()==0){
    echo "<P>La liste est vide";
       ?>
        <div class="titre">Ajouter une personne </div>
            <form action="ajout_pers.php" method="post">
                <table>
                    <tr>
                        <td><label for="inputNom" class="control-label">Nom</label></td>
                            <td><input type="text" name="nom" class="form-control" id="inputNom" placeholder="nom" required value="<?= $data['nom']??""?>"></td>
                    </tr>      <tr>
                        <td><label for="inputPrenom" class="control-label">Prenom</label></td>
                            <td><input type="text" name="prenom" class="form-control" id="inputPrenom" placeholder="prenom" required value="<?= $data['prenom']??""?>"></td>
                    </tr>
    
                </table>
        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
</form>
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
          <td>Nom : <?php echo htmlspecialchars($row['nom'])?></td> 
          <td>Prenom : <?php echo htmlspecialchars($row['prenom'])?></td>
          <td><a href='pers/sup_pers.php?pid=<?php echo $row['pid'] ?>'>Supprimer</a></td>
          <td><a href='pers/mod_form_pers.php?pid=<?php echo $row['pid'] ?>'>Modifier</a></td>
        
    </tr>

<?php
 };  
echo "</table>\n";
    ?>
     <div class="titre">Ajouter une personne </div>
            <form action="ajout_pers.php" method="post">
                <table>
                    <tr>
                        <td><label for="inputNom" class="control-label">Nom</label></td>
                            <td><input type="text" name="nom" class="form-control" id="inputNom" placeholder="nom" required value="<?= $data['nom']??""?>"></td>
                    </tr>      <tr>
                        <td><label for="inputPrenom" class="control-label">Prenom</label></td>
                            <td><input type="text" name="prenom" class="form-control" id="inputPrenom" placeholder="prenom" required value="<?= $data['prenom']??""?>"></td>
                    </tr>
    
                </table>
        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
</form>
    <?php
$db=null;
     };
}catch (PDOException $e){
  echo "Erreur SQL: ".$e->getMessage();
}
include("footer.php");
?>
