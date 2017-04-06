<?php 
if(!isset($_GET['pid']) ){
    include("info_pers.php");
} else {
    $pid = $_GET['pid'];
    require("../db_config.php");
    try{
        $db=new PDO("mysql:host=$hostname;dbname=$dbname",$username);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL="SELECT * FROM itypes";
        $res = $db->query($SQL);
        $db=null;
     }catch (PDOException $e){
         echo "Erreur SQL: ".$e->getMessage();
    } 
}
?>

<div class="titre"> <h4>Ajouter un autre moyen identification </h4></div>
            <form action="ajout_id.php?pid=<?php echo $pid ?>" method="post">
                <table>
                    <tr>
                     
       <label for="inputNomType" class="control-label">identification</label>
                <tr>
                        <select name="tid">
                                <p>
                                    <?php
                                        while($row=$res->fetch()){
                                            echo "<option value=".$row['tid'].">".$row['nom']."</option><br/>";
                                        }
                                    ?>
                                </p>
                        </select>
              </tr>   
    
                    <tr>
                        <td><label for="inputValeur" class="control-label">Valeur</label></td>
                            <td><input type="text" name="valeur" class="form-control" id="inputValeur" placeholder="valeur" required value="<?= $data['valeur']??""?>"></td>
                    </tr>
    
                </table>
        <div class="form-group">
         <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
<?php
include("../footer.php");
?>