<?php
include("../header.php");
if(!isset($_GET['cid'])){
    echo "Erreur: cid non défini";
    echo "CID : " . $_GET['cid'];
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