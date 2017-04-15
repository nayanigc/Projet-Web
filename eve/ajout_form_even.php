<?php 
if(!isset($_GET['eid']) ){
    include("liste_even.php");
} else {
    $eid = $_GET['eid'];
    require("../db_config.php");
    try{
        $db=new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL="SELECT * FROM categories";
        $res = $db->query($SQL);
        $db=null;
     }catch (PDOException $e){
         echo "Erreur SQL: ".$e->getMessage();
    } 
}

?>

<div class="titre"> <h4>Ajouter un evenement </h4></div>
            <form action="ajout_even.php?eid=<?php echo $eid ?>" method="post">
                <table>
                        
<label for="inputNomType" class="control-label">Categories</label>
        <tr>
                        <select class="form-control" name="cid">
                                <p>
                                    <?php
                                        while($row=$res->fetch()){
                                            echo "<option value=".$row['cid'].">".$row['nom']."</option><br/>";
                                        }
                                    ?>
                                </p>
                        </select>
              </tr>   
                   <tr>
            
    <td><label for="inputIntitule" class="control-label">Intitule</label></td>
    <td><input type="text" name="intitule" class="form-control" id="inputIntitule" placeholder="intitule" required value="<?= $data['intitule']??""?>"></td>
                        
     <td><label for="inputDescription" class="control-label">description</label></td>
 <td><input type="text" name="description" class="form-control" id="inputDescription" placeholder="description" required value="<?= $data['description']??""?>"></td>
  
                        
     <td><label for="inputDatedebut" class="control-label">Date de debut </label></td>
    <td><input type="date" name="datedebut" class="form-control" id="inputDatedebut" placeholder="datedebut" required value="<?= $data['datedebut']??""?>"></td>
                        
    <td><label for="inputDateFin" class="control-label">datefin</label></td>
    <td><input type="date" name="datefin" class="form-control" id="inputDateFin" placeholder="datefin" required value="<?= $data['datefin']??""?>"></td>
                      </tr>
     <label for="inputNomType" class="control-label">Type</label>
        <tr>
                        <select name="type">
                                <p>
                                    <?php
                                            echo "<option>Ouvert</option><br/>";
                                             echo "<option>Ferme</option><br/>";
                                    ?>
                                </p>
                        </select>
              </tr>   
                </table>
        <div class="form-group">
         <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
<?php
include("../footer.php");
?>