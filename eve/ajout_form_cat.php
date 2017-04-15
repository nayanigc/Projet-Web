<?php
include("../header.php");
if(!isset($_GET['cid'])){
    echo "Erreur: cid non défini";
    echo "CID : " . $_GET['cid'];
}
?>
<div class="titre">Ajouter un categorie </div>
            <form action="ajout_cat.php" method="post">
                <table>
                    <tr>
                        <td><label for="inputNom" class="control-label">Nom</label></td>
                            <td><input type="text" name="nom" class="form-control" id="inputNom" placeholder="nom" required value="<?= $data['nom']??""?>"></td>
                    </tr>   
                </table>
        <div class="form-group">
         <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
<?php include"../footer.php" ?>