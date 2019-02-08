<?php
require("../auth/EtreAuthentifie.php");
include("../header.php");

if(!isset($_GET['ptid']) ||!isset($_GET['eid'])||!isset($_GET['uid'])||!isset($_GET['pid'])){
    include("info_pers.php");
} else {
    $eid = $_GET['eid'];
    require("../db_config.php");
    try{
        $db=new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL="SELECT * FROM participations INNER JOIN users on participations.uid=users.uid INNER JOIN personnes ON participations.pid = personnes.pid INNER JOIN evenements  on participations.eid = evenements.eid";
		$st = $db->prepare($SQL);
		$res = $st -> execute ();
        $db=null;
     }catch (PDOException $e){
         echo "Erreur SQL: ".$e->getMessage();
    } 
}

?>

<div class="titre"> <h4>Ajouter la liste des evenements </h4></div>
      <form action="ajout_part.php?pid=<?php echo $pid ?>" method="post">
            <table>
		          <label for="inputNomType" class="control-label">nom</label>
                         <tr>
                             <select name="eid">
                                   <p>
                                    <?php
                                        while($row=$res->fetch()){
                                            echo "<option value=".$row['evenements.eid'].">".$row['intitule']."</option><br/>";
                                        }
                                    ?>
                                  </p>
                        </select>
				</tr>   
            
     <label for="inputNomType" class="control-label">identification</label>
        <tr>
                        <select name="uid">
                                <p>
                                   <?php   while($row=$res->fetch()){
                                            echo "<option value=".$row['users.uid'].">".$row['login']."</option><br/>";
                                    		}
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