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
    require("../db_config.php");
    try{
        $db = new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username,$password);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL = "SELECT intitule,description,dateDebut,dateFin,evenements.cid,type FROM evenements INNER JOIN categories ON evenements.cid = categories.cid WHERE eid=?";
        $st= $db->prepare($SQL);
        $res = $st->execute(array($eid));
        while($row=$st->fetch()){
            echo 'Intitule: '.$row['intitule'].'</br>';
            echo 'Description: '.$row['description'].'</br>';
            echo 'DateDebut: '.$row['dateDebut'].'</br>';
            echo 'DateFin: '.$row['dateFin'].'</br>';
            echo 'Categorie: '.$row['cid'].'</br>';
            echo 'type: '.$row['type'].'</br>';
        }
    }catch(PDOException $e){
        echo "Erreur SQL:".$e->getMessage();
    }

?>

<div class="titre">Modifie</div>
            <form action="mod_eve.php?eid=<?php echo $_GET['eid'] ?>" method="post">

<table> 
        <tr>
               <label for="inputNomType" class="control-label">nom</label>
        <tr>
                        <select name="cid">
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
     <label for="inputNomType" class="control-label">type d'evenement</label>
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
   <?php
    include("../footer.php");
                  ?>