<?php
include("../header.php");
if(!isset($_GET['cid'])){
    echo "Erreur: cid non défini";
    echo "CID : " . $_GET['cid'];
}else {
    require("../db_config.php");
    $cid=$_GET['cid'];
    try{
        $db = new PDO("mysql:hostname=$hostname;dbname=$dbname;charset=utf8",$username,$password);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $SQL = "SELECT nom FROM categories WHERE cid=?";
        $st= $db->prepare($SQL);
        $res = $st->execute(array($cid));
        while($row=$st->fetch()){
            echo 'Nom: '.$row['nom'].'</br>';
        }
    }catch(PDOException $e){
        echo "Erreur SQL:".$e->getMessage();
    }
}
?>

<div class="titre">Modifie le nom de la categorie </div>
            <form action="mod_cat.php?cid=<?php echo $_GET['cid'] ?>" method="post">

<table> 
        <tr>
                        <td><label for="inputNom" class="control-label">Nom</label></td>
                            <td><input type="text" name="nom" class="form-control" id="inputNom" placeholder="nom" required value="<?= $data['nom']??""?>"></td>
                    </tr>      <tr>
                </table>
                  <div class="form-group">
                            <button type="submit" class="btn btn-primary"> Valider</button>
                      
                    </div>
   <?php
    include("../footer.php");
                  ?>